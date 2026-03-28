<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
    ];

    //relasi

    //banyak category memiliki banyak produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function firstProduct()
    {
        return $this->hasOne(Product::class)->latestOfMany();
    }
}
