<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PromoCampaign extends Model
{
    public const AUDIENCE_GUESTS = 'guests';

    public const AUDIENCE_ALL = 'all';

    public const AUDIENCE_FIRST_PURCHASE = 'first_purchase';

    protected $fillable = [
        'title',
        'image_path',
        'button_text',
        'button_url',
        'audience',
        'coupon_id',
        'is_active',
        'starts_at',
        'ends_at',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
        ];
    }

    public function coupon(): BelongsTo
    {
        return $this->belongsTo(Coupon::class);
    }

    public function scopeCurrentlyActive(Builder $query): Builder
    {
        $now = now();

        return $query
            ->where('is_active', true)
            ->where(function (Builder $q) use ($now) {
                $q->whereNull('starts_at')->orWhere('starts_at', '<=', $now);
            })
            ->where(function (Builder $q) use ($now) {
                $q->whereNull('ends_at')->orWhere('ends_at', '>=', $now);
            });
    }

    public function isVisibleTo(?User $user): bool
    {
        return match ($this->audience) {
            self::AUDIENCE_ALL => true,
            self::AUDIENCE_GUESTS => $user === null,
            self::AUDIENCE_FIRST_PURCHASE => $user === null || ! $user->hasCompletedPurchase(),
            default => false,
        };
    }
}
