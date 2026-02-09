<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Model;

class QuoteLogo extends Model
{
    protected $fillable = [
        'quote_id',
        'file_path',
        'location',
        'pieces',
    ];

    public function quote(): BelongsTo
    {
        return $this->belongsTo(Quote::class);
    }
}
