<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'seller_id',
        'quantity',
        'price',
        'status',
    ];

    /* =========================
     | RELATIONSHIPS
     ========================= */

    // Item milik order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Item punya product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Item punya seller
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    /* =========================
     | HELPER METHODS (OPTIONAL)
     ========================= */

    // Subtotal item
    public function subtotal(): int
    {
        return $this->price * $this->quantity;
    }

    // Cek apakah sudah dibayar
    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }
}