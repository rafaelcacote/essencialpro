<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminCouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::query()
            ->latest('id')
            ->paginate(20);

        return view('admin.coupons.index', compact('coupons'));
    }

    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateCoupon($request);

        $coupon = Coupon::create($this->payload($validated));

        return redirect()
            ->route('admin.coupons.edit', $coupon)
            ->with('status', 'Cupom criado com sucesso.');
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validated = $this->validateCoupon($request, $coupon);

        $coupon->fill($this->payload($validated))->save();

        return back()->with('status', 'Cupom atualizado com sucesso.');
    }

    public function destroy(Coupon $coupon)
    {
        if ($coupon->orders()->exists()) {
            return back()->with('error', 'Não é possível remover um cupom já utilizado em pedidos. Desative-o.');
        }

        $coupon->delete();

        return redirect()
            ->route('admin.coupons.index')
            ->with('status', 'Cupom removido.');
    }

    private function validateCoupon(Request $request, ?Coupon $coupon = null): array
    {
        $request->merge([
            'code' => strtoupper(trim((string) $request->input('code'))),
            'min_subtotal' => $request->filled('min_subtotal') ? $request->input('min_subtotal') : null,
            'usage_limit' => $request->filled('usage_limit') ? $request->input('usage_limit') : null,
            'starts_at' => $request->filled('starts_at') ? $request->input('starts_at') : null,
            'ends_at' => $request->filled('ends_at') ? $request->input('ends_at') : null,
        ]);

        return $request->validate([
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('coupons', 'code')->ignore($coupon?->id),
            ],
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', Rule::in(['percent', 'fixed'])],
            'value' => ['required', 'numeric', 'min:0.01'],
            'min_subtotal' => ['nullable', 'numeric', 'min:0'],
            'usage_limit' => ['nullable', 'integer', 'min:1'],
            'usage_limit_per_user' => ['nullable', 'integer', 'min:1'],
            'first_order_only' => ['nullable', 'boolean'],
            'is_active' => ['nullable', 'boolean'],
            'starts_at' => ['nullable', 'date'],
            'ends_at' => ['nullable', 'date', 'after_or_equal:starts_at'],
        ], [
            'ends_at.after_or_equal' => 'A data de fim deve ser igual ou posterior à data de início.',
        ]);
    }

    /**
     * @param  array<string, mixed>  $validated
     * @return array<string, mixed>
     */
    private function payload(array $validated): array
    {
        $value = (float) $validated['value'];
        if (($validated['type'] ?? '') === 'percent' && $value > 100) {
            $value = 100;
        }

        return [
            'code' => strtoupper(trim($validated['code'])),
            'name' => $validated['name'],
            'type' => $validated['type'],
            'value' => $value,
            'min_subtotal' => $validated['min_subtotal'] ?? null,
            'usage_limit' => $validated['usage_limit'] ?? null,
            'usage_limit_per_user' => (int) ($validated['usage_limit_per_user'] ?? 1),
            'first_order_only' => (bool) ($validated['first_order_only'] ?? false),
            'is_active' => (bool) ($validated['is_active'] ?? false),
            'starts_at' => $validated['starts_at'] ?? null,
            'ends_at' => $validated['ends_at'] ?? null,
        ];
    }
}
