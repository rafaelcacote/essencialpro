<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
    protected $fillable = [
        'client_type',
        'company_name',
        'contact_name',
        'email',
        'phone',
        'tax_id',
        'address',
        'postal_code',
        'city',
        'country',
        'notes',
        'status',
    ];

    public function items(): HasMany
    {
        return $this->hasMany(QuoteItem::class);
    }

    public function logos(): HasMany
    {
        return $this->hasMany(QuoteLogo::class);
    }
}
