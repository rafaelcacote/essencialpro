<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'code',
        'price',
        'category_id',
        'category_label',
        'description',
        'key_features',
        'technical_specs',
        'is_active',
        'is_featured',
    ];

    protected $casts = [
        'key_features' => 'array',
        'technical_specs' => 'array',
        'is_active' => 'boolean',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order');
    }

    public function getCoverImageUrlAttribute(): ?string
    {
        $first = $this->images->first();
        return $first ? asset($first->path) : null;
    }

    protected static function booted(): void
    {
        static::saving(function (self $product) {
            if (!filled($product->slug) && filled($product->title)) {
                $product->slug = self::generateUniqueSlug($product->title, $product->id);
            }
        });
    }

    private static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base !== '' ? $base : Str::random(8);

        $i = 2;
        while (
            self::query()
                ->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))
                ->where('slug', $slug)
                ->exists()
        ) {
            $slug = $base . '-' . $i;
            $i++;
        }

        return $slug;
    }
}
