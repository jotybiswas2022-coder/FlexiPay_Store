<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\PaymentTransaction;
use App\Models\PlanChangeRequest;
use App\Models\ProductRequest;
use App\Models\ExchangeRequest;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();
        $totalRevenue = PaymentTransaction::where('status', 'success')
            ->where('type', 'payment')
            ->sum('amount');

        $recentOrders = Order::with('user')->latest()->take(10)->get();
        $recentUsers = User::latest()->take(10)->get();

        $pendingPlanChanges = PlanChangeRequest::where('status', 'pending')->count();
        $pendingProductRequests = ProductRequest::where('status', 'pending')->count();
        $pendingExchanges = ExchangeRequest::where('status', 'pending')->count();

        return view('backend.index', compact(
            'totalProducts', 'totalOrders', 'totalUsers', 'totalRevenue',
            'recentOrders', 'recentUsers',
            'pendingPlanChanges', 'pendingProductRequests', 'pendingExchanges'
        ));
    }
}
