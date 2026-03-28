<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\user;
use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $fillable = [
        'seller_id',
        'category_id',
        'name',
        'stock',
        'price',
        'modal',
        'margin',
        'profit',
        'description',
        'image',
    ];

    //Relasi
    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
