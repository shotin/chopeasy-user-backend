<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProcessRecurringOrders extends Command
{
    protected $signature = 'orders:process-recurring';
    protected $description = 'Deduct installment payments for recurring orders';

    public function handle()
    {
        $orders = Order::whereIn('payment_type', ['daily', 'weekly', 'monthly'])
            ->where('remaining_amount', '>', 0)
            ->where('next_due_date', '<=', now())
            ->get();

        foreach ($orders as $order) {
            $user = $order->user;

            $deduction = 0;
            if ($order->payment_type === 'daily') {
                $deduction = round($order->total_amount / 30, 2);
                $order->next_due_date = now()->addDay();
            } elseif ($order->payment_type === 'weekly') {
                $deduction = round($order->total_amount / 4, 2);
                $order->next_due_date = now()->addWeek();
            } elseif ($order->payment_type === 'monthly') {
                $deduction = $order->remaining_amount; // final payment
                $order->next_due_date = now()->addMonth();
            }

            if ($user->main_wallet >= $deduction) {
                DB::beginTransaction();
                try {
                    $user->main_wallet -= $deduction;
                    $user->food_wallet += $deduction;
                    $user->save();

                    $order->amount_paid += $deduction;
                    $order->remaining_amount -= $deduction;

                    if ($order->remaining_amount <= 0) {
                        $order->status = 'ongoing';
                        $order->next_due_date = null;

                        // ✅ Generate vendor_order_code if not already set
                        if (!$order->vendor_order_code) {
                            $code = 'VC-' . strtoupper(Str::random(8));
                            $order->vendor_order_code = $code;

                            // ✅ Sync into vendor_orders table for each item
                            foreach ($order->items as $item) {
                                DB::table('vendor_orders')
                                    ->where('order_item_id', $item->id)
                                    ->update(['vendor_order_code' => $code]);
                            }
                        }
                    }

                    $order->save();

                    Transaction::create([
                        'user_id' => $user->id,
                        'order_id' => $order->id,
                        'type' => 'deduction',
                        'source_wallet' => 'main_wallet',
                        'destination_wallet' => 'food_wallet',
                        'amount' => $deduction,
                        'reference' => $order->order_number,
                        'status' => 'successful',
                        'description' => ucfirst($order->payment_type) . " installment for Order #{$order->id}",
                    ]);

                    DB::commit();
                    $this->info("Processed order #{$order->id} for user {$user->id}");
                } catch (\Throwable $e) {
                    DB::rollBack();
                    $this->error("Error processing order #{$order->id}: " . $e->getMessage());
                }
            } else {
                Transaction::create([
                    'user_id' => $user->id,
                    'order_id' => $order->id,
                    'type' => 'deduction',
                    'source_wallet' => 'main_wallet',
                    'destination_wallet' => 'food_wallet',
                    'amount' => $deduction,
                    'reference' => $order->order_number,
                    'status' => 'failed',
                    'description' => "Failed {$order->payment_type} deduction due to insufficient funds",
                ]);

                $this->warn("Insufficient funds for user {$user->id}, order #{$order->id}");
            }
        }
    }
}
