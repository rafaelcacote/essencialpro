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

    public function isImage(): bool
    {
        $extension = strtolower((string) pathinfo((string) $this->file_path, PATHINFO_EXTENSION));

        return in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'bmp'], true);
    }
}
