<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'buyer_id',
        'total_price',
        'shipping_address',
        'phone',
        'note',
        'payment_status',
        'midtrans_order_id',
    ];

    /* =========================
     | RELATIONSHIPS
     ========================= */

    // Order milik buyer
    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    // Order punya banyak item
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

   /* =========================
     | HELPER METHODS
     ========================= */

    // Cek apakah sudah dibayar
    public function isPaid(): bool
    {
        return $this->payment_status === 'paid';
    }

    // Cek apakah semua item selesai
    public function isCompleted(): bool
    {
        return $this->items()
            ->where('status', '!=', 'completed')
            ->count() === 0;
    }

   public function getStatusAttribute()
    {
        // Kalau belum bayar
        if($this->payment_status === 'pending') return 'unpaid';

        $itemStatuses = $this->items->pluck('status')->unique();

        if($itemStatuses->contains('shipped')) return 'shipped';
        if($itemStatuses->contains('processing') || $itemStatuses->contains('paid')) return 'processing';
        if($itemStatuses->count() === 1 && $itemStatuses->first() === 'completed') return 'completed';

        return 'mixed'; // kalau ada status campur
}
    
}