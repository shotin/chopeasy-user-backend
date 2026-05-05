<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            if (!Schema::hasColumn('orders', 'customer_product_subtotal')) {
                $table->decimal('customer_product_subtotal', 12, 2)
                    ->default(0)
                    ->after('total_amount');
            }

            if (!Schema::hasColumn('orders', 'service_fee_total')) {
                $table->decimal('service_fee_total', 12, 2)
                    ->default(0)
                    ->after('customer_product_subtotal');
            }

            if (!Schema::hasColumn('orders', 'delivery_fee_total')) {
                $table->decimal('delivery_fee_total', 12, 2)
                    ->default(0)
                    ->after('service_fee_total');
            }

            if (!Schema::hasColumn('orders', 'base_fee_total')) {
                $table->decimal('base_fee_total', 12, 2)
                    ->default(0)
                    ->after('delivery_fee_total');
            }

            if (!Schema::hasColumn('orders', 'weight_fee_total')) {
                $table->decimal('weight_fee_total', 12, 2)
                    ->default(0)
                    ->after('base_fee_total');
            }

            if (!Schema::hasColumn('orders', 'distance_fee_total')) {
                $table->decimal('distance_fee_total', 12, 2)
                    ->default(0)
                    ->after('weight_fee_total');
            }
        });

        DB::table('orders')
            ->select([
                'id',
                'total_amount',
                'computed_total_charge',
                'pricing_breakdown',
                'customer_product_subtotal',
                'service_fee_total',
                'delivery_fee_total',
                'base_fee_total',
                'weight_fee_total',
                'distance_fee_total',
            ])
            ->orderBy('id')
            ->chunkById(100, function ($orders) {
                foreach ($orders as $order) {
                    $breakdown = json_decode($order->pricing_breakdown ?? '[]', true) ?: [];

                    DB::table('orders')
                        ->where('id', $order->id)
                        ->update([
                            'customer_product_subtotal' => $breakdown['customer_product_subtotal']
                                ?? $order->customer_product_subtotal
                                ?? max(
                                    ((float) ($order->total_amount ?? 0))
                                    - ((float) ($order->computed_total_charge ?? 0))
                                    - ((float) ($breakdown['service_fee_total'] ?? 0)),
                                    0
                                ),
                            'service_fee_total' => $breakdown['service_fee_total']
                                ?? $breakdown['service_charge_total']
                                ?? $order->service_fee_total
                                ?? 0,
                            'delivery_fee_total' => $breakdown['delivery_fee_total']
                                ?? $breakdown['total_charge']
                                ?? $order->delivery_fee_total
                                ?? $order->computed_total_charge
                                ?? 0,
                            'base_fee_total' => $breakdown['base_fee']
                                ?? $breakdown['base_charge']
                                ?? $order->base_fee_total
                                ?? 0,
                            'weight_fee_total' => $breakdown['weight_fee']
                                ?? $breakdown['weight_service_fee']
                                ?? $order->weight_fee_total
                                ?? 0,
                            'distance_fee_total' => $breakdown['distance_fee']
                                ?? $breakdown['distance_charge_total']
                                ?? $order->distance_fee_total
                                ?? 0,
                        ]);
                }
            });
    }

    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $columns = [
                'customer_product_subtotal',
                'service_fee_total',
                'delivery_fee_total',
                'base_fee_total',
                'weight_fee_total',
                'distance_fee_total',
            ];

            $existing = array_values(array_filter($columns, fn ($column) => Schema::hasColumn('orders', $column)));

            if (!empty($existing)) {
                $table->dropColumn($existing);
            }
        });
    }
};
