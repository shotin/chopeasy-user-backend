<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditLog;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    /**
     * Get dashboard metrics (totals + growth percentages)
     */
    public function metrics(): JsonResponse
    {
        $now = now();
        $lastMonth = $now->copy()->subMonth();

        $totalUsers = User::count();
        $totalOrders = Order::count();
        $totalVendors = User::where('user_type', 'vendor')->count();
        $totalRevenue = (float) Order::whereIn('status', ['delivered', 'completed'])->sum('total_amount');

        $usersLastMonth = User::where('created_at', '<', $lastMonth)->count();
        $usersThisMonth = User::where('created_at', '>=', $lastMonth)->count();
        $usersGrowth = $usersLastMonth > 0 ? round(($usersThisMonth / $usersLastMonth) * 100 - 100, 1) : 0;

        $ordersLastMonth = Order::where('created_at', '<', $lastMonth)->count();
        $ordersThisMonth = Order::where('created_at', '>=', $lastMonth)->count();
        $ordersGrowth = $ordersLastMonth > 0 ? round(($ordersThisMonth / $ordersLastMonth) * 100 - 100, 1) : 0;

        $vendorsLastMonth = User::where('user_type', 'vendor')->where('created_at', '<', $lastMonth)->count();
        $vendorsThisMonth = User::where('user_type', 'vendor')->where('created_at', '>=', $lastMonth)->count();
        $vendorsGrowth = $vendorsLastMonth > 0 ? round(($vendorsThisMonth / $vendorsLastMonth) * 100 - 100, 1) : 0;

        $revenueLastMonth = (float) Order::whereIn('status', ['delivered', 'completed'])
            ->where('created_at', '<', $lastMonth)->sum('total_amount');
        $revenueThisMonth = (float) Order::whereIn('status', ['delivered', 'completed'])
            ->where('created_at', '>=', $lastMonth)->sum('total_amount');
        $revenueGrowth = $revenueLastMonth > 0 ? round(($revenueThisMonth / $revenueLastMonth) * 100 - 100, 1) : 0;

        return response()->json([
            'data' => [
                'total_users' => $totalUsers,
                'total_orders' => $totalOrders,
                'total_vendors' => $totalVendors,
                'total_revenue' => $totalRevenue,
                'users_growth' => $usersGrowth,
                'orders_growth' => $ordersGrowth,
                'vendors_growth' => $vendorsGrowth,
                'revenue_growth' => $revenueGrowth,
            ],
        ]);
    }

    /**
     * Get chart data (orders and revenue by month)
     */
    public function chartData(Request $request): JsonResponse
    {
        $months = (int) $request->query('months', 12);
        $start = now()->subMonths($months);

        $driver = DB::connection()->getDriverName();
        if ($driver === 'mysql') {
            $ordersByMonth = Order::selectRaw('DATE_FORMAT(created_at, "%Y-%m") as month, COUNT(*) as orders, COALESCE(SUM(total_amount), 0) as revenue')
                ->where('created_at', '>=', $start)
                ->groupBy('month')
                ->orderBy('month')
                ->get();
        } else {
            $ordersByMonth = Order::selectRaw("strftime('%Y-%m', created_at) as month, COUNT(*) as orders, COALESCE(SUM(total_amount), 0) as revenue")
                ->where('created_at', '>=', $start)
                ->groupBy('month')
                ->orderBy('month')
                ->get();
        }

        $monthNames = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        $data = $ordersByMonth->map(function ($row) use ($monthNames) {
            [$y, $m] = explode('-', $row->month);
            return [
                'date' => $monthNames[(int) $m - 1],
                'orders' => (int) $row->orders,
                'revenue' => (float) $row->revenue,
            ];
        });

        return response()->json(['data' => $data]);
    }

    /**
     * Get recent activity (from audit logs + recent orders/users/vendors)
     */
    public function recentActivity(): JsonResponse
    {
        $activities = collect();

        if (class_exists(AuditLog::class)) {
            $auditLogs = AuditLog::with('causer')
                ->latest()
                ->take(15)
                ->get();

            foreach ($auditLogs as $log) {
                $activities->push([
                    'id' => 'al-' . $log->id,
                    'message' => $log->description ?? $log->log_name ?? 'System activity',
                    'type' => 'system',
                    'timestamp' => $log->created_at->diffForHumans(),
                    '_sort' => $log->created_at->timestamp,
                ]);
            }
        }

        $recentOrders = Order::with('user')->latest()->take(5)->get();
        foreach ($recentOrders as $order) {
            $activities->push([
                'id' => 'ord-' . $order->id,
                'message' => 'Order ' . $order->order_number . ' ' . $order->status,
                'type' => 'order',
                'timestamp' => $order->created_at->diffForHumans(),
                '_sort' => $order->created_at->timestamp,
            ]);
        }

        $recentUsers = User::latest()->take(3)->get();
        foreach ($recentUsers as $user) {
            $activities->push([
                'id' => 'usr-' . $user->id,
                'message' => 'User ' . ($user->fullname ?? $user->email) . ' registered',
                'type' => 'user',
                'timestamp' => $user->created_at->diffForHumans(),
                '_sort' => $user->created_at->timestamp,
            ]);
        }

        $recentVendors = User::where('user_type', 'vendor')->latest()->take(3)->get();
        foreach ($recentVendors as $vendor) {
            $activities->push([
                'id' => 'vend-' . $vendor->id,
                'message' => 'Vendor "' . ($vendor->store_name ?? $vendor->fullname) . '" registered',
                'type' => 'vendor',
                'timestamp' => $vendor->created_at->diffForHumans(),
                '_sort' => $vendor->created_at->timestamp,
            ]);
        }

        $activities = $activities->sortByDesc('_sort')->take(10)->map(function ($a) {
            unset($a['_sort']);
            return $a;
        })->values();

        return response()->json(['data' => $activities]);
    }
}
