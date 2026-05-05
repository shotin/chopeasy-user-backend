<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AgentEarning;
use App\Models\AgentWithdrawal;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminAgentWithdrawalController extends Controller
{
    /**
     * List agent withdrawal requests
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('per_page', 20);
        $status = $request->query('status');
        $search = $request->query('search');

        $query = AgentWithdrawal::with(['agent:id,fullname,email,main_wallet', 'lines'])
            ->when($status, fn($q) => $q->where('status', $status))
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q2) use ($search) {
                    $q2->where('bank_name', 'like', "%{$search}%")
                        ->orWhere('account_number', 'like', "%{$search}%")
                        ->orWhere('account_name', 'like', "%{$search}%")
                        ->orWhereHas('agent', function ($q3) use ($search) {
                            $q3->where('fullname', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                        });
                });
            })
            ->orderByDesc('created_at');

        $withdrawals = $query->paginate($perPage);

        $formatted = $withdrawals->map(fn($w) => $this->formatWithdrawal($w));

        return response()->json([
            'data' => $formatted,
            'pagination' => [
                'currentPage' => $withdrawals->currentPage(),
                'lastPage' => $withdrawals->lastPage(),
                'perPage' => $withdrawals->perPage(),
                'total' => $withdrawals->total(),
            ],
        ]);
    }

    /**
     * List approved withdrawal history
     */
    public function history(Request $request): JsonResponse
    {
        $perPage = $request->query('per_page', 20);
        $search = $request->query('search');

        $query = AgentWithdrawal::with(['agent:id,fullname,email,main_wallet', 'lines'])
            ->whereIn('status', ['approved', 'paid'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($q2) use ($search) {
                    $q2->where('bank_name', 'like', "%{$search}%")
                        ->orWhere('account_number', 'like', "%{$search}%")
                        ->orWhere('account_name', 'like', "%{$search}%")
                        ->orWhereHas('agent', function ($q3) use ($search) {
                            $q3->where('fullname', 'like', "%{$search}%")
                                ->orWhere('email', 'like', "%{$search}%");
                        });
                });
            })
            ->orderByDesc('updated_at');

        $withdrawals = $query->paginate($perPage);

        $formatted = $withdrawals->map(fn($w) => $this->formatWithdrawal($w));

        return response()->json([
            'data' => $formatted,
            'pagination' => [
                'currentPage' => $withdrawals->currentPage(),
                'lastPage' => $withdrawals->lastPage(),
                'perPage' => $withdrawals->perPage(),
                'total' => $withdrawals->total(),
            ],
        ]);
    }

    /**
     * Approve a pending withdrawal request
     */
    public function approve(int $id): JsonResponse
    {
        return DB::transaction(function () use ($id) {
            $withdrawal = AgentWithdrawal::with('agent:id,fullname,email,main_wallet')
                ->lockForUpdate()
                ->find($id);

            if (!$withdrawal) {
                return response()->json(['error' => 'Withdrawal not found'], 404);
            }

            if ($withdrawal->status !== 'pending') {
                return response()->json(['error' => 'Withdrawal already processed'], 422);
            }

            $withdrawal->status = 'approved';
            $withdrawal->save();

            return response()->json([
                'data' => $this->formatWithdrawal($withdrawal->fresh('agent')),
            ]);
        });
    }

    /**
     * Reject a pending withdrawal and refund the wallet
     */
    public function reject(int $id): JsonResponse
    {
        return DB::transaction(function () use ($id) {
            $withdrawal = AgentWithdrawal::with('agent:id,fullname,email,main_wallet')
                ->lockForUpdate()
                ->find($id);

            if (!$withdrawal) {
                return response()->json(['error' => 'Withdrawal not found'], 404);
            }

            if ($withdrawal->status !== 'pending') {
                return response()->json(['error' => 'Withdrawal already processed'], 422);
            }

            if (!$withdrawal->agent) {
                return response()->json(['error' => 'Agent not found for withdrawal'], 422);
            }

            AgentEarning::where('withdrawal_id', $withdrawal->id)->update(['withdrawal_id' => null]);
            $withdrawal->lines()->delete();

            $withdrawal->status = 'rejected';
            $withdrawal->save();

            $withdrawal->agent->increment('main_wallet', $withdrawal->amount);

            return response()->json([
                'data' => $this->formatWithdrawal($withdrawal->fresh('agent')),
            ]);
        });
    }

    private function formatWithdrawal(AgentWithdrawal $withdrawal): array
    {
        $agent = $withdrawal->agent;
        $withdrawal->loadMissing('lines');

        return [
            'id' => (string) $withdrawal->id,
            'agent_id' => (string) $withdrawal->agent_id,
            'agent_name' => $agent?->fullname ?? 'Unknown',
            'agent_email' => $agent?->email ?? '',
            'agent_wallet' => $agent ? (float) $agent->main_wallet : null,
            'amount' => (float) $withdrawal->amount,
            'status' => $withdrawal->status,
            'bank_name' => $withdrawal->bank_name,
            'bank_code' => $withdrawal->bank_code,
            'account_number' => $withdrawal->account_number,
            'account_name' => $withdrawal->account_name,
            'created_at' => $withdrawal->created_at?->format('Y-m-d H:i') ?? '',
            'approved_at' => $withdrawal->updated_at?->format('Y-m-d H:i') ?? '',
            'linked_commissions' => $withdrawal->lines->map(fn ($l) => [
                'order_number' => $l->order_number,
                'earning_type' => $l->earning_type,
                'amount' => (float) $l->amount,
            ])->values()->all(),
        ];
    }
}
