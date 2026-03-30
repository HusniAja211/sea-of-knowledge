<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::where('buyer_id', Auth::id())->first();

        $cartItems = $cart
            ? $cart->items()->with(['product.category'])->get()
            : collect();

        return view('pages.buyer.cart', compact('cartItems'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $buyerId = Auth::id();

        // 1. Cari / buat cart
        $cart = Cart::firstOrCreate([
            'buyer_id' => $buyerId,
        ]);

        // 2. Ambil produk dari DB (INI WAJIB)
        $product = Product::findOrFail($request->product_id);

        // 3. Cek apakah produk sudah ada di cart
        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            // 4. Jika sudah ada → tambah quantity
            $item->increment('quantity');
        } else {
            // 5. Jika belum → buat cart item baru
            CartItem::create([
                'cart_id'    => $cart->id,
                'product_id' => $product->id,
                'seller_id'  => $product->seller_id,
                'quantity'   => 1,
                'price'      => $product->price,    
            ]);
        }

        return back()->with('success', 'Product added to cart');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'action' => 'required|in:increment,decrement'
        ]);

        $cart = Cart::where('buyer_id', Auth::id())->firstOrFail();

        $item = CartItem::where('id', $id)
            ->where('cart_id', $cart->id)
            ->with('product')
            ->firstOrFail();

        if ($request->action === 'increment') {

            // Optional: cek stok
            if ($item->quantity >= $item->product->stock) {
                return back()->with('error', 'Insufficient stock.');
            }

            $item->increment('quantity');
        }

        if ($request->action === 'decrement') {
            if ($item->quantity <= 1) {
                $item->delete();
            } else {
                $item->decrement('quantity');
            }
        }

        return back();
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::where('buyer_id', Auth::id())->firstOrFail();

        $item = CartItem::where('id', $id)
            ->where('cart_id', $cart->id)
            ->firstOrFail();

        $item->delete();

        return back()->with('success', 'Item removed from cart');
    }
}