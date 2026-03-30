<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;

class CheckoutController extends Controller
{
    /**
     * Store checkout data and create orders per seller
     */
    public function store(Request $request)
    {
        $buyer = Auth::user();

        /* =========================
        | VALIDASI INPUT
        ========================= */
        $validated = $request->validate([
            'shipping_address' => 'required|string',
            'phone'            => 'required|string',
            'note'             => 'nullable|string',
        ]);

        /* =========================
        | AMBIL CART
        ========================= */
        $cart = Cart::with('items.product')
            ->where('buyer_id', $buyer->id)
            ->first();

        if (! $cart || $cart->items->isEmpty()) {
            return redirect()->back()
                ->with('error', 'Shopping cart is empty.');
        }

        DB::beginTransaction();

        try {

            /* =========================
            | HITUNG TOTAL SEMUA ITEM
            ========================= */
            $totalPrice = $cart->items->sum(function ($item) {
                return $item->price * $item->quantity;
            });

            /* =========================
            | BUAT 1 ORDER SAJA
            ========================= */
            $order = Order::create([
                'buyer_id'         => $buyer->id,
                'total_price'      => $totalPrice,
                'shipping_address' => $validated['shipping_address'],
                'phone'            => $validated['phone'],
                'note'             => $validated['note'] ?? null,
                'payment_status'   => 'pending',
            ]);

            /* =========================
            | BUAT ORDER ITEMS
            ========================= */
            foreach ($cart->items as $item) {

                OrderItem::create([
                    'order_id'   => $order->id,
                    'product_id' => $item->product_id,
                    'seller_id'  => $item->seller_id,
                    'quantity'   => $item->quantity,
                    'price'      => $item->price,
                    'status'     => 'pending',
                ]);
            }

            /* =========================
            | HAPUS CART
            ========================= */
            $cart->items()->delete();

            DB::commit();

        } catch (\Throwable $e) {
            DB::rollBack();

            // report($e);
            dd($e->getMessage(), $e->getFile(), $e->getLine());

            return redirect()->back()
                ->with('error', 'Checkout failed.');
        }

        return redirect()
            ->route('buyer.orders.index')
            ->with('success', 'Order created. Please proceed to payment.');
    }
}