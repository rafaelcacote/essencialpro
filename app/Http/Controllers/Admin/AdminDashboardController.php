<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Quote;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::query()->count();
        $activeProducts = Product::query()->where('is_active', true)->count();
        $featuredProducts = Product::query()->where('is_active', true)->where('is_featured', true)->count();

        $totalQuotes = Quote::query()->count();
        $pendingQuotes = Quote::query()->where('status', 'pending')->count();

        $latestPendingQuotes = Quote::query()
            ->where('status', 'pending')
            ->latest()
            ->limit(5)
            ->get();

        $latestProducts = Product::query()
            ->latest()
            ->limit(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalProducts',
            'activeProducts',
            'featuredProducts',
            'totalQuotes',
            'pendingQuotes',
            'latestPendingQuotes',
            'latestProducts',
        ));
    }
}
