<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'user_id',
        'cart_id',
        'contact_name',
        'email',
        'phone',
        'company_name',
        'tax_id',
        'address',
        'postal_code',
        'city',
        'country',
        'notes',
        'subtotal',
        'shipping_total',
        'discount_total',
        'coupon_id',
        'coupon_code',
        'tax_total',
        'grand_total',
        'status',
        'payment_id',
        'eupago_reference',
        'eupago_entity',
        'payment_method',
        'payment_status',
        'easypay_checkout_id',
        'payment_expires_at',
        'paid_at',
    ];

    protected function casts(): array
    {
        return [
            'paid_at' => 'datetime',
            'payment_expires_at' => 'datetime',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
