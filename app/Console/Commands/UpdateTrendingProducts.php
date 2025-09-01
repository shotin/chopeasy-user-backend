<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class UpdateTrendingProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-trending-products';
    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the top trending products based on sales data from OrderDetail';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Calculate trending products based on sales volume in the last 7 days
        $trendingProducts = DB::table('order_details')
            ->select('product_id', 'product_variant_id', DB::raw('COUNT(*) as total_sales'))
            ->where('created_at', '>=', Carbon::now()->subDays(7)) 
            ->groupBy('product_id', 'product_variant_id')
            ->orderBy('total_sales', 'DESC')
            ->limit(4)
            ->get();

        DB::table('trending_products')->truncate();

        foreach ($trendingProducts as $index => $product) {
            DB::table('trending_products')->insert([
                'product_id' => $product->product_id,
                'product_variant_id' => $product->product_variant_id,
                'rank' => $index + 1, // Assign rank based on position
                'total_sales' => $product->total_sales,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->info('Trending products updated successfully!');
    }
}
