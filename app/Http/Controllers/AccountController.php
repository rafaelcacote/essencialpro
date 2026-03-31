<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function dashboard(Request $request)
    {
        $latestOrders = Order::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->limit(5)
            ->get();

        return view('pages.account.dashboard', compact('latestOrders'));
    }

    public function orders(Request $request)
    {
        $orders = Order::query()
            ->where('user_id', $request->user()->id)
            ->latest()
            ->paginate(10);

        return view('pages.account.orders', compact('orders'));
    }

    public function showOrder(Request $request, Order $order)
    {
        abort_unless($order->user_id === $request->user()->id, 403);
        $order->load('items.product.images');

        return view('pages.account.order-show', compact('order'));
    }
}
