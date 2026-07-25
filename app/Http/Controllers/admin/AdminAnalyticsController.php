<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;

class AdminAnalyticsController extends Controller
{
    public function index()
    {
        $totalOrders = Order::count();
        $totalRevenue = Order::where('status', 'completed')->sum('grand_total');
        $totalUsers = User::count();
        $totalProducts = Product::count();

        $recentOrders = Order::with('user')->latest()->take(10)->get();

        $monthlyRevenue = Order::where('status', 'completed')
            ->whereYear('created_at', now()->year)
            ->selectRaw('MONTH(created_at) as month, SUM(grand_total) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month');

        $ordersByStatus = Order::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status');

        return view('backend.analytics.index', compact(
            'totalOrders', 'totalRevenue', 'totalUsers', 'totalProducts',
            'recentOrders', 'monthlyRevenue', 'ordersByStatus'
        ));
    }

    public function export()
    {
        $orders = Order::with('user')->latest()->get();

        $csv = "Order #,Customer,Amount,Status,Date\n";
        foreach ($orders as $order) {
            $csv .= "{$order->order_number},{$order->user->name},{$order->grand_total},{$order->status},{$order->created_at}\n";
        }

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="analytics_export.csv"',
        ]);
    }
}
