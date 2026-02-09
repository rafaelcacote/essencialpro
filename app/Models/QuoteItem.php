<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class QuoteItem extends Model
{
    protected $fillable = [
        'quote_id',
        'product_name',
        'reference',
        'quantity',
        'color',
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }
}
