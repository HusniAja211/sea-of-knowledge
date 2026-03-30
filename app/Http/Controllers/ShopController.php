<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderItem;

class ShopController extends Controller
{
    public function show(User $seller)
    {
        // Pastikan user yang dilihat adalah role 'seller'
        if ($seller->role->name !== 'seller') {
            abort(404);
        }

        // Ambil produk milik seller tersebut dengan pagination
        $products = Product::where('seller_id', $seller->id)
            ->where('stock', '>', 0) // Opsional: hanya tampilkan yg ada stok
            ->latest()
            ->paginate(12);

        // Hitung statistik sederhana
        // $totalSold = OrderItem::whereHas('product', function($q) use ($seller) {
        //     $q->where('seller_id', $seller->id);
        // })->whereHas('order', function($q) {
        //     $q->where('status', 'finished');
        // })->sum('quantity');

        return view('pages.buyer.shop', compact('seller', 'products'));
    }
}
