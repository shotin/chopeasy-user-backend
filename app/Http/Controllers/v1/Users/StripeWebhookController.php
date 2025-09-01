<?php

namespace App\Http\Controllers\v1\Users;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Log;

class StripeWebhookController extends Controller
{
    public function handle(Request $request)
    {
        $payload = $request->all();

        if (isset($payload['type']) && $payload['type'] === 'checkout.session.completed') {
            $session = $payload['data']['object'];
            $orderId = $session['metadata']['order_id'] ?? null;

            if ($orderId) {
                $order = Order::find($orderId);
                if ($order && $order->payment_status !== 'paid') {
                    $order->update(['payment_status' => 'paid']);
                    Log::info("Order {$order->order_number} marked as paid.");
                }
            }
        }

        return response()->json(['status' => 'ok'], 200);
    }
}
