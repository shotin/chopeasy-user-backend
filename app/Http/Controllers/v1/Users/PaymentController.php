<?php

namespace App\Http\Controllers\v1\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\User;

class PaymentController extends Controller
{
    /**
     * Step 1: Initialize Paystack payment
     */
    public function initialize(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:100',
        ]);

        $amountInKobo = $request->amount * 100;
        $user = $request->user();

        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->post(env('PAYSTACK_PAYMENT_URL') . '/transaction/initialize', [
                'email'        => $user->email,
                'amount'       => $amountInKobo,
                // redirect straight to your frontend instead of hitting backend callback
                'callback_url' => config('app.frontend_url') . "/payment-success",
                'metadata'     => [
                    'cancel_action' => config('app.frontend_url') . "/payment-failed",
                    'user_id'       => $user->id,
                ],
            ]);

        return response()->json($response->json());
    }


    /**
     * Step 2: Paystack callback (redirect to frontend success/failed page)
     */
    public function callback(Request $request)
    {
        $reference = $request->query('reference') ?? $request->query('trxref');

        $verifyUrl = env('PAYSTACK_PAYMENT_URL') . "/transaction/verify/{$reference}";
        $response  = Http::withToken(env('PAYSTACK_SECRET_KEY'))->get($verifyUrl)->json();

        $frontendUrl = rtrim(config('app.frontend_url'), '/');

        if ($response['status'] && $response['data']['status'] === 'success') {
            return redirect()->away("{$frontendUrl}/payment-success?reference={$reference}");
        }

        return redirect()->away("{$frontendUrl}/payment-failed?reference={$reference}");
    }

    /**
     * Step 3: Verify payment (frontend can call this API)
     */
    public function verify(Request $request)
    {
        $request->validate([
            'reference' => 'required|string',
        ]);

        $reference = $request->reference;

        $response = Http::withToken(env('PAYSTACK_SECRET_KEY'))
            ->get(env('PAYSTACK_PAYMENT_URL') . "/transaction/verify/{$reference}")
            ->json();

        if ($response['status'] && $response['data']['status'] === 'success') {
            $amount = $response['data']['amount'] / 100;
            $email  = $response['data']['customer']['email'];

            $user = User::where('email', $email)->first();

            if ($user) {
                $user->increment('main_wallet', $amount);
            }

            return response()->json([
                'error'       => "false",
                'message'     => 'Payment successful, wallet credited',
                'amount_paid' => $amount,
                'main_wallet' => $user ? $user->main_wallet : null,
            ]);
        }

        return response()->json([
            'message' => 'Payment failed',
            'data'    => $response,
        ], 400);
    }
}
