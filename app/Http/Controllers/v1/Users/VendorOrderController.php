<?php


namespace App\Http\Controllers\v1\Users;

use Illuminate\Http\Request;
use App\Models\VendorOrder;
use App\Models\Order;
use App\Events\OrderReadyForPickup;
use App\Http\Controllers\Controller;
use App\Models\OrderItem;

class VendorOrderController extends Controller
{
    /**
     * List vendor's completed/paid orders
     */
    public function vendorOrders(Request $request)
    {
        $user = $request->user();

        if ($user->user_type !== 'vendor') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $orders = Order::with([
            'user',
            'items.vendorOrders' => function ($q) use ($user) {
                $q->where('vendor_id', $user->id);
            }
        ])
            ->where('payment_status', 'paid')
            ->whereHas('items.vendorOrders', function ($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })
            ->latest()
            ->get();

        return response()->json($orders);
    }

    /**
     * List items for a single order (expand "View More")
     */
    public function orderItems(Request $request, $orderId)
    {
        $user = $request->user();

        if ($user->user_type !== 'vendor') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $order = Order::with([
            'items.vendorOrders' => function ($q) use ($user) {
                $q->where('vendor_id', $user->id);
            }
        ])
            ->where('id', $orderId)
            ->whereHas('items.vendorOrders', function ($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })
            ->firstOrFail();

        // Only vendor-specific items
        $vendorItems = $order->items->filter(function ($item) use ($user) {
            return $item->vendorOrders->where('vendor_id', $user->id)->isNotEmpty();
        });

        // Format response: pull from product_snapshot
        $formatted = $vendorItems->map(function ($item) {
            $snapshot = is_array($item->product_snapshot)
                ? $item->product_snapshot
                : json_decode($item->product_snapshot, true);

            return [
                'id'            => $item->id,
                'product_id'    => $item->product_id,
                'quantity'      => $item->quantity,
                'price'         => $item->price_at_order,
                'name'          => $snapshot['name'] ?? null,
                'image'         => $snapshot['image'] ?? null,
                'snapshot'      => $snapshot,

                // Alias columns properly
                'order_item_id' => $item->id ?? null,
                'item_status'   => $item->status ?? null, // 👈 order_items.status
                'order_status'  => $item->order->status ?? null,      // 👈 orders.status
                'vendor_orders' => $item->vendorOrders,
            ];
        });

        return response()->json($formatted->values());
    }
    /**
     * Vendor marks ONE order item as ready
     */
    public function toggleItemReady(Request $request, $orderItemId)
    {
        $user = $request->user();

        if ($user->user_type !== 'vendor') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $orderItem = OrderItem::with('order')
            ->where('id', $orderItemId)
            ->whereHas('vendorOrders', function ($q) use ($user) {
                $q->where('vendor_id', $user->id);
            })
            ->firstOrFail();

        $order = $orderItem->order;

        if ($order->status === 'ready') {
            return response()->json([
                'message' => 'This order is already marked ready and cannot be updated.',
                'order_status' => $order->status,
                'item_status'  => $orderItem->status,
                'order_id'     => $order->id,
            ], 403);
        }

        // Toggle status
        $newStatus = $orderItem->status === 'ready' ? null : 'ready';
        $orderItem->update(['status' => $newStatus]);

        $allReady = $order->items()
            ->whereHas('vendorOrders', fn($q) => $q->where('vendor_id', $user->id))
            ->where(fn($q) => $q->whereNull('status')->orWhere('status', '!=', 'ready'))
            ->count() === 0;

        if ($allReady) {
            $order->update(['status' => 'ready']);
            event(new OrderReadyForPickup($order));
        } else {
            $order->update(['status' => 'pending']);
        }

        return response()->json([
            'message'      => $newStatus === 'ready' ? 'Item marked ready' : 'Item unmarked',
            'order_status' => $order->status,
            'item_status'  => $orderItem->status,
            'order_id'     => $order->id,
        ]);
    }
}
