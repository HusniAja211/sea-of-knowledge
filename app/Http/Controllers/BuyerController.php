<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::latest()->paginate(5);

        // PRODUCTS
        $products = Product::with(['category', 'seller'])
            ->when($request->category, function ($query, $categoryId) {
                $query->where('category_id', $categoryId);
            })
            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhereHas('category', fn($q2) =>
                        $q2->where('name', 'like', "%{$search}%")
                    )
                    ->orWhereHas('seller', fn($q3) =>
                        $q3->where('name', 'like', "%{$search}%")
                    );
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // SELLERS
        $sellers = User::whereHas('role', function ($q) {
                $q->where('name', 'seller');
            })
            ->when($request->search, fn($q, $search) =>
                $q->where('name', 'like', "%{$search}%")
            )
            ->limit(5)
            ->get();

        // CATEGORIES (SEARCH)
        $searchedCategories = Category::when($request->search, fn($q, $search) =>
                $q->where('name', 'like', "%{$search}%")
            )
            ->limit(5)
            ->get();

        // 🔥 UNIFIED RESULTS
        $results = collect();

        if ($request->search) {

            $productResults = $products->getCollection()->map(function ($product) {
                return [
                    'type' => 'product',
                    'name' => $product->name,
                    'image' => $product->image ? asset('storage/' . $product->image) : null,
                    'category' => $product->category->name ?? 'General',
                    'seller' => $product->seller->name ?? 'Store',
                    'price' => $product->price,
                    'url' => route('buyer.product.show', $product),
                ];
            });

            $sellerResults = $sellers->map(function ($seller) {
                return [
                    'type' => 'seller',
                    'name' => $seller->name,
                    'image' => $seller->avatar_url ?? 'https://ui-avatars.com/api/?name=' . urlencode($seller->name),
                    'url' => route('buyer.seller.shop', $seller->id),
                ];
            });

            $categoryResults = $searchedCategories->map(function ($cat) {
                return [
                    'type' => 'category',
                    'name' => $cat->name,
                    'image' => null,
                    'url' => route('buyer.index', ['category' => $cat->id]),
                ];
            });

            $results = $productResults
            ->merge($sellerResults)
            ->merge($categoryResults)
            ->sortByDesc(fn($item) => match($item['type']) {
                'product' => 3,
                'seller' => 2,
                'category' => 1,
            })
            ->values();
                }

        return view('pages.buyer.index', compact(
            'products',
            'categories',
            'results'
        ));
    }

    public function show(Product $product)
    {
        $product->load(['category', 'seller']);

        $relatedProducts = Product::with(['category', 'seller'])
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('pages.buyer.show', compact('product', 'relatedProducts'));
    }

    public function orders(Request $request)
    {
        $status = $request->status ?? 'all';

        $orders = Order::with('items.product')
            ->where('buyer_id', Auth::id())
            ->when($status == 'unpaid', fn($q) => $q->where('payment_status', 'pending'))
            ->when($status == 'processing', fn($q) =>
                $q->where('payment_status', 'paid')
                ->whereHas('items', fn($qi) => $qi->whereIn('status', ['paid','processing']))
            )
            ->when($status == 'shipped', fn($q) =>
                $q->whereHas('items', fn($qi) => $qi->where('status', 'shipped'))
            )
            ->when($status == 'completed', fn($q) =>
                $q->whereHas('items', fn($qi) => $qi->where('status', 'completed'))
            )
            ->latest()
            ->paginate(10);

        return view('pages.buyer.order', compact('orders', 'status'));
    }

    public function showOrder($id)
    {
        $order = Order::with('items.product')
            ->where('buyer_id', Auth::id())
            ->findOrFail($id);
    
        return view('pages.buyer.payment', compact('order'));
    }
}
