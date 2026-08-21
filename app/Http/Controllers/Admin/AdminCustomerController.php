<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Quote;
use App\Models\User;
use Illuminate\Http\Request;

class AdminCustomerController extends Controller
{
    public function index(Request $request)
    {
        $verified = $request->input('verified');

        $customers = User::query()
            ->customers()
            ->withCount('orders')
            ->when(trim((string) $request->input('q')), function ($query, $term) {
                $query->where(function ($q) use ($term) {
                    $q->where('name', 'like', '%'.$term.'%')
                        ->orWhere('email', 'like', '%'.$term.'%');
                });
            })
            ->when($verified === '1', fn ($q) => $q->whereNotNull('email_verified_at'))
            ->when($verified === '0', fn ($q) => $q->whereNull('email_verified_at'))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    public function show(User $customer)
    {
        abort_if($customer->is_admin, 404);

        $orders = $customer->orders()->latest()->paginate(10, ['*'], 'pedidos');
        $latestOrder = $customer->orders()->latest()->first();
        $quotes = Quote::query()
            ->whereRaw('LOWER(email) = ?', [mb_strtolower($customer->email)])
            ->latest()
            ->limit(20)
            ->get();

        $spentTotal = $customer->orders()
            ->where(function ($q) {
                $q->where('payment_status', 'paid')
                    ->orWhereNotNull('paid_at')
                    ->orWhereIn('status', ['paid', 'completed']);
            })
            ->sum('grand_total');

        return view('admin.customers.show', compact(
            'customer',
            'orders',
            'latestOrder',
            'quotes',
            'spentTotal',
        ));
    }
}
