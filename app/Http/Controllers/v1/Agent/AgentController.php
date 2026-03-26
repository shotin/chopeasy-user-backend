<?php

namespace App\Http\Controllers\v1\Agent;

use App\Http\Controllers\Controller;
use App\Models\AgentEarning;
use App\Models\AgentWithdrawal;
use App\Responser\JsonResponser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AgentController extends Controller
{
    /**
     * Agent dashboard: wallet balance, total earnings, referral count, recent earnings.
     * Requires auth:api and user_type = agent.
     */
    public function dashboard(Request $request)
    {
        $user = $request->user();

        if ($user->user_type !== 'agent') {
            return JsonResponser::send(true, 'Access denied. Agent only.', null, 403);
        }

        $totalEarnings = AgentEarning::where('agent_id', $user->id)->sum('amount');
        $referredCount = $user->referredCustomers()->count();
        $recentEarnings = AgentEarning::where('agent_id', $user->id)
            ->with('order:id,order_number,total_amount,created_at')
            ->latest()
            ->take(10)
            ->get();

        $bankDetails = $user->agentBankDetails;

        // Referral link: frontend base URL + ?ref=agent_id or a code
        $referralCode = (string) $user->id;
        $referralLink = 'https://chopeasy.ng/register?type=customer&ref=' . $referralCode;

        return JsonResponser::send(false, 'Dashboard loaded.', [
            'user' => [
                'id' => $user->id,
                'fullname' => $user->fullname,
                'email' => $user->email,
                'phoneno' => $user->phoneno,
                'user_type' => $user->user_type,
            ],
            'wallet_balance' => (float) $user->main_wallet,
            'total_earnings' => (float) $totalEarnings,
            'referred_customers_count' => $referredCount,
            'referral_link' => $referralLink,
            'referral_code' => $referralCode,
            'bank_details' => $bankDetails ? [
                'bank_name' => $bankDetails->bank_name,
                'bank_code' => $bankDetails->bank_code,
                'account_number' => $bankDetails->account_number,
                'account_name' => $bankDetails->account_name,
            ] : null,
            'recent_earnings' => $recentEarnings->map(function ($e) {
                return [
                    'id' => $e->id,
                    'order_number' => $e->order?->order_number,
                    'order_amount' => (float) $e->order_amount,
                    'commission_percent' => (float) $e->commission_percent,
                    'amount' => (float) $e->amount,
                    'created_at' => $e->created_at->toIso8601String(),
                ];
            }),
        ], 200);
    }

    /**
     * Update agent bank details. Agent must be logged in and user_type = agent.
     */
    public function updateBankDetails(Request $request)
    {
        $user = $request->user();

        if ($user->user_type !== 'agent') {
            return JsonResponser::send(true, 'Access denied. Agent only.', null, 403);
        }

        $validator = Validator::make($request->all(), [
            'bank_name' => 'required|string|max:255',
            'bank_code' => 'required|string|max:50',
            'account_number' => 'required|string|max:50',
            'account_name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 422);
        }

        $user->agentBankDetails()->updateOrCreate(
            ['user_id' => $user->id],
            $validator->validated()
        );

        return JsonResponser::send(false, 'Bank details updated.', [
            'bank_details' => $user->agentBankDetails()->first(),
        ], 200);
    }

    /**
     * Fetch banks from Paystack for dropdowns.
     */
    public function listBanks(Request $request)
    {
        $user = $request->user();

        if ($user->user_type !== 'agent') {
            return JsonResponser::send(true, 'Access denied. Agent only.', null, 403);
        }

        if (!env('PAYSTACK_SECRET_KEY')) {
            return JsonResponser::send(true, 'Paystack secret key not configured.', null, 500);
        }

        $baseUrl = rtrim(env('PAYSTACK_PAYMENT_URL', 'https://api.paystack.co'), '/');
        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->get($baseUrl . '/bank', [
                'country' => 'nigeria',
            ]);

        if (!$response->ok() || !($response->json('status') === true)) {
            $message = $response->json('message') ?? 'Unable to load banks.';
            return JsonResponser::send(true, $message, null, 422);
        }

        $banks = collect($response->json('data') ?? [])
            ->map(fn ($bank) => [
                'name' => $bank['name'] ?? '',
                'code' => $bank['code'] ?? '',
            ])
            ->filter(fn ($bank) => $bank['name'] && $bank['code'])
            ->values();

        return JsonResponser::send(false, 'Banks loaded.', [
            'banks' => $banks,
        ], 200);
    }

    /**
     * Resolve account name via Paystack.
     */
    public function resolveBankDetails(Request $request)
    {
        $user = $request->user();

        if ($user->user_type !== 'agent') {
            return JsonResponser::send(true, 'Access denied. Agent only.', null, 403);
        }

        $validator = Validator::make($request->all(), [
            'bank_code' => 'required|string|max:50',
            'account_number' => 'required|string|max:50',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 422);
        }

        if (!env('PAYSTACK_SECRET_KEY')) {
            return JsonResponser::send(true, 'Paystack secret key not configured.', null, 500);
        }

        $payload = $validator->validated();
        $bankCode = trim($payload['bank_code']);
        $accountNumber = trim($payload['account_number']);

        $baseUrl = rtrim(env('PAYSTACK_PAYMENT_URL', 'https://api.paystack.co'), '/');
        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->get($baseUrl . '/bank/resolve', [
                'account_number' => $accountNumber,
                'bank_code' => $bankCode,
            ]);

        if (!$response->ok() || !($response->json('status') === true)) {
            $message = $response->json('message') ?? 'Unable to resolve account name.';
            return JsonResponser::send(true, $message, null, 422);
        }

        $data = $response->json('data') ?? [];

        return JsonResponser::send(false, 'Account resolved.', [
            'account_name' => $data['account_name'] ?? null,
            'bank_name' => $data['bank_name'] ?? null,
            'bank_code' => $bankCode,
            'account_number' => $accountNumber,
        ], 200);
    }

    /**
     * Request withdrawal for agent earnings.
     */
    public function requestWithdrawal(Request $request)
    {
        $user = $request->user();

        if ($user->user_type !== 'agent') {
            return JsonResponser::send(true, 'Access denied. Agent only.', null, 403);
        }

        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator->errors()->first(),
                'data' => null,
            ], 422);
        }

        $bankDetails = $user->agentBankDetails;
        if (!$bankDetails) {
            return JsonResponser::send(true, 'Please add your bank details before withdrawing.', null, 422);
        }

        $amount = (float) $validator->validated()['amount'];

        if ($user->main_wallet < $amount) {
            return JsonResponser::send(true, 'Insufficient wallet balance.', null, 422);
        }

        $withdrawal = null;

        DB::transaction(function () use ($user, $bankDetails, $amount, &$withdrawal) {
            $withdrawal = AgentWithdrawal::create([
                'agent_id' => $user->id,
                'amount' => $amount,
                'status' => 'pending',
                'bank_name' => $bankDetails->bank_name,
                'bank_code' => $bankDetails->bank_code,
                'account_number' => $bankDetails->account_number,
                'account_name' => $bankDetails->account_name,
            ]);

            $user->decrement('main_wallet', $amount);
        });

        return JsonResponser::send(false, 'Withdrawal request submitted.', [
            'withdrawal' => $withdrawal,
            'wallet_balance' => (float) $user->fresh()->main_wallet,
        ], 200);
    }
}
