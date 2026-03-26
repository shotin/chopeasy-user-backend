<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminNotificationController extends Controller
{
    /**
     * List admin notifications (derived from recent system events)
     * Uses recent orders, new vendors, etc. as notification sources
     */
    public function index(Request $request): JsonResponse
    {
        $perPage = $request->query('per_page', 20);
        $notifications = collect();

        $recentOrders = Order::with('user')->latest()->take(30)->get();
        foreach ($recentOrders as $order) {
            $type = match ($order->status) {
                'delivered', 'completed' => 'success',
                'cancelled' => 'error',
                'pending' => 'warning',
                default => 'info',
            };
            $notifications->push([
                'id' => 'ord-' . $order->id,
                'title' => 'Order ' . $order->order_number,
                'message' => 'Order status: ' . $order->status . ($order->user ? ' - Customer: ' . $order->user->fullname : ''),
                'type' => $type,
                'read' => false,
                'created_at' => $order->created_at->format('Y-m-d H:i'),
            ]);
        }

        $newVendors = User::where('user_type', 'vendor')->where('created_at', '>=', now()->subDays(7))->get();
        foreach ($newVendors as $vendor) {
            $notifications->push([
                'id' => 'vend-' . $vendor->id,
                'title' => 'New Vendor Registration',
                'message' => ($vendor->store_name ?? $vendor->fullname) . ' has registered and is awaiting approval.',
                'type' => 'info',
                'read' => false,
                'created_at' => $vendor->created_at->format('Y-m-d H:i'),
            ]);
        }

        $notifications = $notifications->sortByDesc('created_at')->take($perPage)->values();

        return response()->json([
            'data' => $notifications,
        ]);
    }
}
