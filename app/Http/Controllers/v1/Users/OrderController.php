<?php

namespace App\Http\Controllers\v1\Users;

use App\Helpers\ProductWeightHelper;
use App\Http\Controllers\Controller;
use App\Mail\OrderInvoiceMail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\OrderStatusLog;
use App\Models\ShippingAddress;
use App\Models\Transaction;
use App\Services\SendcloudService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Cookie as SymfonyCookie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class OrderController extends Controller
{

    protected function getSessionId(Request $request, &$cookie = null): ?string
    {
        $existing = $request->cookie('cart_session_id');

        if ($existing) {
            return $existing;
        }

        $sessionId = Str::uuid()->toString();
        $secure = app()->environment('production') || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');
        $sameSite = $secure ? 'None' : 'Lax';

        $cookie = new SymfonyCookie(
            'cart_session_id',
            $sessionId,
            now()->addYear(),
            '/',
            null,
            $secure,
            false,
            false,
            $sameSite
        );

        return $sessionId;
    }

  public function checkout(Request $request)
{
    $request->validate([
        'payment_type' => 'required|in:outright,daily,weekly,monthly',
        'items' => 'required|array|min:1',
        'items.*.product_id' => 'required|integer',
        'items.*.quantity' => 'required|integer|min:1',
        'items.*.price' => 'required|numeric|min:0',
    ]);

    $user = $request->user();
    if (!$user) {
        return response()->json(['error' => 'User not authenticated'], 401);
    }

    $totalAmount = collect($request->items)->sum(fn($item) => $item['price'] * $item['quantity']);

    try {
        DB::beginTransaction();

        // Calculate initial amount for installment
        $amountPaid = 0;
        $remainingAmount = $totalAmount;
        $nextDueDate = null;

        if ($request->payment_type === 'outright') {
            if ($user->main_wallet < $totalAmount) {
                DB::rollBack();
                return response()->json(['error' => 'Insufficient funds in main wallet'], 400);
            }

            $amountPaid = $totalAmount;
            $remainingAmount = 0;
            $nextDueDate = null;

            // Deduct outright payment
            $user->main_wallet -= $totalAmount;
            $user->food_wallet += $totalAmount;
            $user->save();
        } else {
            // Define next due date based on payment_type
            $nextDueDate = match ($request->payment_type) {
                'daily' => now()->addDay(),
                'weekly' => now()->addWeek(),
                'monthly' => now()->addMonth(),
            };

            // Automatically deduct first installment from main_wallet
            $installmentAmount = match ($request->payment_type) {
                'daily' => round($totalAmount / 30, 2),
                'weekly' => round($totalAmount / 4, 2),
                'monthly' => round($totalAmount, 2), // full month
            };

            if ($user->main_wallet < $installmentAmount) {
                DB::rollBack();
                return response()->json(['error' => 'Insufficient funds for first installment'], 400);
            }

            $user->main_wallet -= $installmentAmount;
            $user->food_wallet += $installmentAmount;
            $user->save();

            $amountPaid = $installmentAmount;
            $remainingAmount = $totalAmount - $installmentAmount;

            // Record first installment transaction
            Transaction::create([
                'user_id' => $user->id,
                'order_id' => null,
                'type' => 'deduction',
                'source_wallet' => 'main_wallet',
                'destination_wallet' => 'food_wallet',
                'amount' => $installmentAmount,
                'reference' => 'INSTALLMENT-' . strtoupper(Str::random(8)),
                'status' => 'successful',
                'description' => ucfirst($request->payment_type) . " installment for Order",
            ]);
        }

        // Create order
        $order = Order::create([
            'user_id' => $user->id,
            'order_number' => 'ORD-' . strtoupper(Str::random(8)),
            'total_amount' => $totalAmount,
            'status' => $request->payment_type === 'outright' ? 'completed' : 'ongoing',
            'payment_type' => $request->payment_type,
            'payment_status' => $request->payment_type === 'outright' ? 'paid' : 'installment',
            'amount_paid' => $amountPaid,
            'remaining_amount' => $remainingAmount,
            'next_due_date' => $nextDueDate,
        ]);

        // Add items
        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price_at_order' => $item['price'],
                'product_snapshot' => $item,
            ]);
        }

        DB::commit();

        return response()->json([
            'message' => 'Order placed successfully',
            'order' => $order->load('items'),
            'user' => $user,
        ]);
    } catch (\Throwable $e) {
        DB::rollBack();
        return response()->json([
            'error' => 'Checkout failed',
            'details' => $e->getMessage(),
        ], 500);
    }
}


    public function getUserOrders(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $perPage = $request->query('per_page', 10);

        $orders = Order::where('user_id', $user->id)
            ->with('items')
            ->latest()
            ->paginate($perPage);

        return response()->json([
            'orders' => $orders->items(),
            'pagination' => [
                'currentPage' => $orders->currentPage(),
                'lastPage' => $orders->lastPage(),
                'perPage' => $orders->perPage(),
                'total' => $orders->total(),
            ],
        ]);
    }


    public function getOrderDetails($orderId, Request $request)
    {
        Auth::shouldUse('api');
        $userId = Auth::check() ? Auth::id() : null;
        $sessionId = $userId ? null : $this->getSessionId($request);

        try {
            $order = Order::with(['items', 'statusLogs'])
                ->where('id', $orderId)
                ->when($userId, fn($q) => $q->where('user_id', $userId))
                ->when(!$userId, fn($q) => $q->where('session_id', $sessionId))
                ->firstOrFail();

            return response()->json([
                'order' => $order,
                'stages' => $order->statusLogs
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Order not found.',
            ], 404);
        }
    }

    protected function getDefaultOrderStages(): array
    {
        $now = now();

        return [
            [
                'status' => 'confirmed',
                'message' => 'Your order has been received and confirmed. We’re preparing it for processing.',
                'fulfilled_at' => $now,
            ],
            [
                'status' => 'preparing',
                'message' => 'Your order is being prepared. We’ll notify you once it’s ready to ship.',
                'fulfilled_at' => null,
            ],
            [
                'status' => 'packed',
                'message' => 'Your order is packed and ready to leave our store.',
                'fulfilled_at' => null,
            ],
            [
                'status' => 'shipped',
                'message' => 'Your order is on its way!',
                'fulfilled_at' => null,
            ],
            [
                'status' => 'delivered',
                'message' => 'Delivered',
                'fulfilled_at' => null,
            ],
        ];
    }

    public function getAllOrdersForAdmin(Request $request)
    {
        $perPage = $request->query('per_page', 10);
        $search = $request->query('search');
        $status = $request->query('status');
        $paymentStatus = $request->query('payment_status');
        $startDate = $request->query('start_date');
        $endDate = $request->query('end_date');

        $ordersQuery = Order::with(['user', 'shippingAddress'])
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('order_number', 'like', "%$search%")
                        ->orWhereHas('user', function ($userQuery) use ($search) {
                            $userQuery->where('firstname', 'like', "%$search%")
                                ->orWhere('email', 'like', "%$search%");
                        });
                });
            })
            ->when($status, fn($q) => $q->where('status', $status))
            ->when($paymentStatus, fn($q) => $q->where('payment_status', $paymentStatus))
            ->when($startDate, fn($q) => $q->whereDate('created_at', '>=', $startDate))
            ->when($endDate, fn($q) => $q->whereDate('created_at', '<=', $endDate))
            ->latest();

        $orders = $ordersQuery->paginate($perPage);

        // Format orders
        $formattedOrders = $orders->map(function ($order) {
            $customer = optional($order->shipping_address_snapshot)['first_name'] . ' ' .
                optional($order->shipping_address_snapshot)['last_name'];

            return [
                'id' => $order->id,
                'order_number' => $order->order_number,
                'date' => $order->created_at,
                'customer' => trim($customer) ?: optional($order->user)->firstname,
                'total' => $order->total_amount,
                'status' => $order->status,
                'payment_status' => $order->payment_status,
            ];
        });

        // Dashboard Stats
        $statsQuery = clone $ordersQuery;
        $totalOrders = (clone $statsQuery)->count();
        $pendingOrders = (clone $statsQuery)->where('status', 'ongoing')->count();
        $completedOrders = (clone $statsQuery)->where('status', 'delivered')->count();
        $avgOrderValue = (clone $statsQuery)->avg('total_amount');

        return response()->json([
            'data' => $formattedOrders,
            'pagination' => [
                'currentPage' => $orders->currentPage(),
                'lastPage' => $orders->lastPage(),
                'perPage' => $orders->perPage(),
                'total' => $orders->total(),
            ],
            'stats' => [
                'totalOrders' => $totalOrders,
                'pendingOrders' => $pendingOrders,
                'completedOrders' => $completedOrders,
                'avgOrderValue' => round($avgOrderValue, 2),
            ]
        ]);
    }

    public function getOrderDetailsForAdmin($orderId)
    {
        try {
            $order = Order::with([
                'items',
                'user',
                'shippingAddress',
                'statusLogs'
            ])->findOrFail($orderId);

            $shipping = $order->shipping_address_snapshot ?? [];
            $customerName = trim(($shipping['first_name'] ?? '') . ' ' . ($shipping['last_name'] ?? ''));

            $response = [
                'order_number' => $order->order_number,
                'status' => $order->status,
                'payment_status' => $order->payment_status,
                'created_at' => $order->created_at->toDateTimeString(),
                'notes' => $order->note ?? null,

                'order_items' => $order->items->map(function ($item) {
                    return [
                        'product_id' => $item->product_id,
                        'name' => $item->product_snapshot['name'] ?? null,
                        'image' => $item->product_snapshot['image'] ?? null,
                        'quantity' => $item->quantity,
                        'unit_price' => $item->price_at_order,
                        'total' => $item->quantity * $item->price_at_order,
                    ];
                })->toArray(),

                'summary' => [
                    'subtotal' => $order->total_amount,
                    'discount' => $order->discount ?? 0,
                    'tax' => $order->tax ?? 0,
                    'shipping_fee' => $order->shipping_fee ?? 0,
                    'total' => ($order->total_amount - ($order->discount ?? 0)) + ($order->tax ?? 0) + ($order->shipping_fee ?? 0),
                ],

                'shipping' => [
                    'method' => $order->shipping_method ?? 'Not specified',
                    'tracking_number' => $order->tracking_number ?? null,
                    'estimated_delivery' => $order->estimated_delivery ?? null,
                    'status' => $order->delivery_status ?? null,
                ],

                'customer' => [
                    'name' => $customerName ?: optional($order->user)->firstname,
                    'email' => $shipping['email'] ?? optional($order->user)->email,
                    'phone' => $shipping['phone_number'] ?? optional($order->user)->phone_number,
                    'registered' => $order->user_id ? 'Yes' : 'No',
                ],

                'shipping_address' => [
                    'line_1' => $shipping['address_line_1'] ?? null,
                    'line_2' => $shipping['address_line_2'] ?? null,
                    'city' => $shipping['city'] ?? null,
                    'state' => $shipping['state'] ?? null,
                    'country' => $shipping['country'] ?? null,
                    'postal_code' => $shipping['postal_code'] ?? null,
                ],

                'status_logs' => $order->statusLogs->map(function ($log) {
                    return [
                        'status' => $log->status,
                        'message' => $log->message,
                        'fulfilled_at' => optional($log->fulfilled_at)->toDateTimeString(),
                    ];
                }),
            ];

            return response()->json(['order' => $response]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'error' => true,
                'message' => 'Order not found.',
            ], 404);
        }
    }

    public function userTransactions(Request $request)
    {
        $user = $request->user();

        $transactions = Transaction::where('user_id', $user->id)
            ->latest()
            ->paginate(20);

        return response()->json([
            'error' => false,
            'message' => 'Transactions retrieved successfully',
            'data' => $transactions
        ]);
    }
}
