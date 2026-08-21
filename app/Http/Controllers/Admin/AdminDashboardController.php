<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Quote;
use App\Models\User;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::query()->count();
        $activeProducts = Product::query()->where('is_active', true)->count();
        $featuredProducts = Product::query()->where('is_active', true)->where('is_featured', true)->count();

        $totalQuotes = Quote::query()->count();
        $pendingQuotes = Quote::query()->where('status', 'pending')->count();
        $totalOrders = Order::query()->count();
        $pendingOrders = Order::query()->where('status', 'pending')->count();
        $totalCustomers = User::query()->customers()->count();
        $recentCustomers = User::query()->customers()->where('created_at', '>=', now()->subDays(30))->count();

        $latestPendingQuotes = Quote::query()
            ->where('status', 'pending')
            ->latest()
            ->limit(5)
            ->get();

        $latestProducts = Product::query()
            ->latest()
            ->limit(5)
            ->get();

        $latestPendingOrders = Order::query()
            ->where('status', 'pending')
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'activeProducts',
            'featuredProducts',
            'totalQuotes',
            'pendingQuotes',
            'totalOrders',
            'pendingOrders',
            'totalCustomers',
            'recentCustomers',
            'latestPendingQuotes',
            'latestPendingOrders',
            'latestProducts',
        ));
    }
}
