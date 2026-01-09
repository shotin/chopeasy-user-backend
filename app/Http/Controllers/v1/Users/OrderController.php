<?php

namespace App\Http\Controllers\v1\Users;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Cookie as SymfonyCookie;
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
             'delivery_address' => 'required|string|max:255',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|integer',
            'items.*.name' => 'required|string|max:255',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.image' => 'nullable|string',
            'items.*.vendor_id' => 'required|integer',
        ]);

        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        $totalAmount = collect($request->items)->sum(
            fn($item) => $item['price'] * $item['quantity']
        );

        try {
            DB::beginTransaction();

            $amountPaid = 0;
            $remainingAmount = $totalAmount;
            $nextDueDate = null;

            $mainVendorOrderCode = strtoupper(Str::random(8));

            if ($request->payment_type === 'outright') {
                if ($user->main_wallet < $totalAmount) {
                    DB::rollBack();
                    return response()->json(['error' => 'Insufficient funds in main wallet'], 400);
                }

                $amountPaid = $totalAmount;
                $remainingAmount = 0;

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

                // Auto deduct first installment
                $installmentAmount = match ($request->payment_type) {
                    'daily' => round($totalAmount / 30, 2),
                    'weekly' => round($totalAmount / 4, 2),
                    'monthly' => round($totalAmount, 2), // full month upfront
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

                // Record installment transaction
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

            // Create main order
            $order = Order::create([
                'user_id' => $user->id,
                'order_number' => 'ORD-' . strtoupper(Str::random(8)),
                'total_amount' => $totalAmount,
                'status' => 'ongoing',
                'payment_type' => $request->payment_type,
                'payment_status' => $request->payment_type === 'outright' ? 'paid' : 'installment',
                'amount_paid' => $amountPaid,
                'remaining_amount' => $remainingAmount,
                'next_due_date' => $nextDueDate,
                'vendor_order_code' => $mainVendorOrderCode,
                'delivery_address' => $request->delivery_address,
            ]);

            // Save order items + vendor_orders rows
            foreach ($request->items as $item) {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price_at_order' => $item['price'],
                    'product_snapshot' => [
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'name' => $item['name'],
                        'price' => $item['price'],
                        'image' => $item['image'] ?? null,
                        'vendor_id' => $item['vendor_id'],
                    ],
                ]);

                // Insert into vendor_orders directly
                DB::table('vendor_orders')->insert([
                    'vendor_id' => $item['vendor_id'],
                    'order_item_id' => $orderItem->id,
                    'vendor_order_code' => $mainVendorOrderCode, // same code for all vendors in this order
                    'created_at' => now(),
                    'updated_at' => now(),
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

    public function update(Request $request, Order $order)
    {
        $request->validate([
            'payment_type' => 'nullable|in:outright,daily,weekly,monthly',
            'items' => 'required|array|min:1',
            'items.*.id' => 'nullable|integer|exists:order_items,id',
            'items.*.name' => 'required|string|max:255',
            'items.*.product_id' => 'required|integer',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.image' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $user = $request->user();

            // Recalculate total
            $totalAmount = collect($request->items)->sum(
                fn($item) => $item['price'] * $item['quantity']
            );

            $paymentType = $request->payment_type ?? $order->payment_type;
            $amountPaid = $order->amount_paid; // already contributed
            $remainingAmount = $totalAmount - $amountPaid;
            $nextDueDate = $order->next_due_date;
            $paymentStatus = $order->payment_status;

            // If user switches payment type
            if ($paymentType !== $order->payment_type) {
                if ($paymentType === 'outright') {
                    // Deduct remaining balance at once
                    if ($user->main_wallet < $remainingAmount) {
                        DB::rollBack();
                        return response()->json([
                            'error' => 'Insufficient funds to complete outright payment'
                        ], 400);
                    }

                    $user->main_wallet -= $remainingAmount;
                    $user->food_wallet += $remainingAmount;
                    $user->save();

                    $amountPaid = $totalAmount;
                    $remainingAmount = 0;
                    $nextDueDate = null;
                    $paymentStatus = 'paid';

                    // Record transaction
                    Transaction::create([
                        'user_id' => $user->id,
                        'order_id' => $order->id,
                        'type' => 'deduction',
                        'source_wallet' => 'main_wallet',
                        'destination_wallet' => 'food_wallet',
                        'amount' => $remainingAmount,
                        'reference' => 'OUTRIGHT-' . strtoupper(Str::random(8)),
                        'status' => 'successful',
                        'description' => "Outright payment for Order {$order->order_number}",
                    ]);
                } else {
                    // Recalculate installment for new plan
                    $installmentAmount = match ($paymentType) {
                        'daily' => round($totalAmount / 30, 2),
                        'weekly' => round($totalAmount / 4, 2),
                        'monthly' => round($totalAmount, 2),
                    };

                    if ($user->main_wallet < $installmentAmount) {
                        DB::rollBack();
                        return response()->json([
                            'error' => 'Insufficient funds for first installment',
                        ], 400);
                    }

                    // Deduct and update wallets
                    $user->main_wallet -= $installmentAmount;
                    $user->food_wallet += $installmentAmount;
                    $user->save();

                    $amountPaid = $installmentAmount;
                    $remainingAmount = $totalAmount - $installmentAmount;
                    $nextDueDate = match ($paymentType) {
                        'daily' => now()->addDay(),
                        'weekly' => now()->addWeek(),
                        'monthly' => now()->addMonth(),
                    };
                    $paymentStatus = 'installment';

                    // Record transaction
                    Transaction::create([
                        'user_id' => $user->id,
                        'order_id' => $order->id,
                        'type' => 'deduction',
                        'source_wallet' => 'main_wallet',
                        'destination_wallet' => 'food_wallet',
                        'amount' => $installmentAmount,
                        'reference' => strtoupper($paymentType) . '-' . strtoupper(Str::random(8)),
                        'status' => 'successful',
                        'description' => ucfirst($paymentType) . " installment for Order {$order->order_number}",
                    ]);
                }

                $order->payment_type = $paymentType;
            }

            // Update order amounts
            $order->update([
                'total_amount' => $totalAmount,
                'amount_paid' => $amountPaid,
                'remaining_amount' => $remainingAmount,
                'next_due_date' => $nextDueDate,
                'payment_status' => $paymentStatus,
            ]);

            // Update / create items
            foreach ($request->items as $itemData) {
                if (!empty($itemData['id'])) {
                    $orderItem = OrderItem::find($itemData['id']);
                    $orderItem->update([
                        'product_id' => $itemData['product_id'],
                        'quantity' => $itemData['quantity'],
                        'price_at_order' => $itemData['price'],
                        'product_snapshot' => [
                            'product_id' => $itemData['product_id'],
                            'quantity' => $itemData['quantity'],
                            'name' => $itemData['name'],
                            'price' => $itemData['price'],
                            'image' => $itemData['image'] ?? null,
                        ],
                    ]);
                } else {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $itemData['product_id'],
                        'quantity' => $itemData['quantity'],
                        'price_at_order' => $itemData['price'],
                        'product_snapshot' => [
                            'product_id' => $itemData['product_id'],
                            'quantity' => $itemData['quantity'],
                            'name' => $itemData['name'],
                            'price' => $itemData['price'],
                            'image' => $itemData['image'] ?? null,
                        ],
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Order updated successfully',
                'order' => $order->fresh()->load('items'),
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Update failed',
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

    public function reorder(Request $request, $orderId)
    {
        $request->validate([
            'payment_type' => 'required|in:outright,daily,weekly,monthly',
        ]);

        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'User not authenticated'], 401);
        }

        // Fetch completed/paid order
        $oldOrder = Order::with('items')
            ->where('id', $orderId)
            ->where('user_id', $user->id)
            ->where(function ($q) {
                $q->where('remaining_amount', 0)
                    ->orWhere('payment_status', 'paid');
            })
            ->first();

        if (!$oldOrder) {
            return response()->json(['error' => 'Order not found or not completed'], 404);
        }

        // Calculate total amount again
        $totalAmount = $oldOrder->items->sum(function ($item) {
            $price = $item->product_snapshot['price'] ?? $item->price_at_order;
            return $price * $item->quantity;
        });

        // Check wallet balance
        if ($user->main_wallet < $totalAmount) {
            return response()->json(['error' => 'Insufficient funds in main wallet'], 400);
        }

        // Deduct funds
        $user->main_wallet -= $totalAmount;
        $user->save();

        // Create new order
        $newOrder = Order::create([
            'user_id'          => $user->id,
            'payment_type'     => $request->payment_type,
            'total_amount'     => $totalAmount,
            'amount_paid'      => $totalAmount,
            'order_number'     => 'ORD-' . strtoupper(Str::random(8)),
            'vendor_order_code' =>  strtoupper(Str::random(8)),
            'remaining_amount' => 0,
            'payment_status'   => 'paid',
            'next_due_date'    => null,
            'status'           => 'ongoing',
        ]);

        // Copy items
        foreach ($oldOrder->items as $item) {
            $newOrder->items()->create([
                'product_id'        => $item->product_id,
                'quantity'          => $item->quantity,
                'price_at_order'    => $item->product_snapshot['price'] ?? $item->price_at_order,
                'product_snapshot'  => $item->product_snapshot,
            ]);
        }

        // Record transaction
        Transaction::create([
            'user_id'            => $user->id,
            'order_id'           => $newOrder->id,
            'type'               => 'deduction',
            'source_wallet'      => 'main_wallet',
            'destination_wallet' => 'food_wallet',
            'amount'             => $totalAmount,
            'reference'          => $newOrder->order_number,
            'status'             => 'successful',
            'description'        => "Reorder placed successfully for Order #{$oldOrder->order_number}",
        ]);

        return response()->json([
            'message'      => 'Reorder successful',
            'order'        => $newOrder->load('items'),
            'new_balance'  => $user->main_wallet,
            'vendor_code'  => $newOrder->vendor_order_code,
        ]);
    }

    public function availablePickups(Request $request)
    {
        $rider = $request->user();

        if ($rider->user_type !== 'rider') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $orders = Order::with(['items.vendorOrders.vendor', 'user'])
            ->where('status', 'ready')
            ->whereNull('accepted_by')
            ->get()
            ->map(function ($order) {
                // get vendor from first vendorOrder
                $vendor = optional(optional($order->items->first())->vendorOrders->first())->vendor;

                return [
                    'id' => $order->id,
                    'order_number' => $order->order_number,

                    // Vendor details
                    'vendor_name'   => $vendor->fullname ?? null,
                    'vendor_phone'  => $vendor->phoneno ?? null,
                    'pickup_address' => $vendor->address ?? null,

                    // Customer details
                    'customer_name'  => $order->user->fullname ?? null,
                    'customer_phone' => $order->user->phoneno ?? null,
                    'dropoff_address' => $order->delivery_address,

                    'status'      => $order->status,
                    'accepted_by' => $order->accepted_by,

                    'items' => $order->items->map(function ($item) {
                        $snapshot = is_array($item->product_snapshot)
                            ? $item->product_snapshot
                            : json_decode($item->product_snapshot, true);

                        return [
                            'id'       => $item->id,
                            'name'     => $snapshot['name'] ?? null,
                            'image'    => $snapshot['image'] ?? null,
                            'quantity' => $item->quantity,
                            'price'    => $item->price_at_order,
                            'status'   => $item->status,
                        ];
                    })->values(),
                ];
            });

        return response()->json($orders);
    }



    public function acceptDelivery(Request $request, $orderId)
    {
        $rider = $request->user();

        if ($rider->user_type !== 'rider') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $order = Order::where('id', $orderId)
            ->where('status', 'ready')
            ->whereNull('accepted_by')
            ->first();

        if (!$order) {
            return response()->json(['error' => 'Order already taken or not available'], 400);
        }

        $order->update([
            'accepted_by' => $rider->id,
            'status' => 'ongoing',
        ]);

        return response()->json([
            'message' => 'Delivery accepted successfully',
            'order_id' => $order->id,
            'status' => $order->status,
        ]);
    }

    public function myPickups(Request $request)
    {
        $rider = $request->user();

        if ($rider->user_type !== 'rider') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $orders = Order::with(['items.vendorOrders.vendor', 'user']) // include vendor + customer
            ->where('accepted_by', $rider->id)
            ->whereIn('status', ['ready', 'ongoing'])
            ->get()
            ->map(function ($order) {
                // assuming one vendor per order, else you can collect() multiple vendors
                $vendor = optional($order->items->first()->vendorOrders->first()->vendor);

                return [
                    'id'            => $order->id,
                    'order_number'  => $order->order_number,
                    // vendor details
                    'vendor_name'   => $vendor->fullname ?? null,
                    'vendor_phone'  => $vendor->phoneno ?? null,
                    'vendor_address' => $vendor->address ?? null,
                    // customer details
                    'customer_name' => $order->user->fullname ?? null,
                    'customer_phone' => $order->user->phoneno ?? null,
                    'customer_address' => $order->delivery_address,
                    // order meta
                    'status'        => $order->status,
                    'accepted_by'   => $order->accepted_by,
                    'items'         => $order->items->map(function ($item) {
                        $snapshot = is_array($item->product_snapshot)
                            ? $item->product_snapshot
                            : json_decode($item->product_snapshot, true);

                        return [
                            'id'       => $item->id,
                            'name'     => $snapshot['name'] ?? null,
                            'image'    => $snapshot['image'] ?? null,
                            'quantity' => $item->quantity,
                            'price'    => $item->price_at_order,
                            'status'   => $item->status,
                        ];
                    })->values(),
                ];
            });

        return response()->json($orders);
    }
}
