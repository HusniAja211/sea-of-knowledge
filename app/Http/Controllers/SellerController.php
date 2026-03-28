<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

use App\Models\Product;
// use App\Models\Order;
use App\Models\Category;
// use App\Models\Message;

class SellerController extends Controller
{
    /**
     * Seller Dashboard Page
     */
    public function index()
    {
        $seller = Auth::user();

        /* =========================
         | Koleksi / Kategori
         ========================= */
        $collections = Category::withCount([
            'products as items' => function ($query) use ($seller) {
                $query->where('seller_id', $seller->id);
            }
        ])->get()->map(function ($category) {
            return [
                'name'  => $category->name,
                'icon'  => $category->icon ?? '📚',
                'items' => $category->items,
                'bg'    => 'bg-green-50',
            ];
        });

        /* =========================
         | Pesanan Masuk (Pending)
         ========================= */
        // $incomingOrders = Order::with(['items.product', 'buyer'])
        //     ->whereHas('items', function ($q) use ($seller) {
        //         $q->where('seller_id', $seller->id);
        //     })
        //     ->where('status', 'waiting_for_approve')
        //     ->latest()
        //     ->take(5)
        //     ->get();

        /* =========================
         | Pesan Terbaru
         ========================= */
        // $messages = Message::whereHas('chat', function ($q) use ($seller) {
        //         $q->where('seller_id', $seller->id);
        //     })
        //     ->latest()
        //     ->take(3)
        //     ->get()
        //     ->map(function ($message) {
        //         return [
        //             'name'    => $message->sender->name,
        //             'message' => $message->message,
        //             'time'    => $message->created_at->diffForHumans(),
        //         ];
        //     });

        /* =========================
        | Ambil gambar kategori dari produk pertama mereka
        ========================= */

        $categories = Category::with('firstProduct')->get();


        return view('pages.seller.index', [
            'user'           => $seller,
            'collections'    => $collections,
            // 'incomingOrders' => $incomingOrders,
            // 'messages'       => $messages,
            'today'          => Carbon::now(),
            'categories'     => $categories,
        ]);
    }
}