<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'name',
        'type',
        'value',
        'min_subtotal',
        'usage_limit',
        'usage_limit_per_user',
        'used_count',
        'first_order_only',
        'is_active',
        'starts_at',
        'ends_at',
    ];

    protected function casts(): array
    {
        return [
            'value' => 'decimal:2',
            'min_subtotal' => 'decimal:2',
            'usage_limit' => 'integer',
            'usage_limit_per_user' => 'integer',
            'used_count' => 'integer',
            'first_order_only' => 'boolean',
            'is_active' => 'boolean',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public function promoCampaigns(): HasMany
    {
        return $this->hasMany(PromoCampaign::class);
    }

    public function isPercent(): bool
    {
        return $this->type === 'percent';
    }

    public function label(): string
    {
        if ($this->isPercent()) {
            return rtrim(rtrim(number_format((float) $this->value, 2, ',', '.'), '0'), ',') . '%';
        }

        return number_format((float) $this->value, 2, ',', '.') . ' €';
    }
}
