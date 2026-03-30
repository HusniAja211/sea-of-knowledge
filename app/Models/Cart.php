<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

use App\Models\User;
use App\Models\CartItem;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{

    protected $fillable = [
        'buyer_id',
    ];

    // Relasi
    
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

}
