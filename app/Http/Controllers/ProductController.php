<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class ProductController extends Controller
{

    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Product::class, 'product');

    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('seller_id', Auth::id())
            ->latest()
            ->paginate(10);
            
        return view('pages.seller.product.index', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('pages.seller.product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'       => 'required|string|max:255',
            'stock'       => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
            'modal'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $profit = $validated['price'] - $validated['modal']; 
        $margin = $validated['price'] > 0 ? ($profit / $validated['price']) * 100 : 0;

         $product = Product::create([
            'seller_id'  => Auth::id(),
            'category_id'=> $validated['category_id'],
            'name'      => $validated['name'],
            'stock'      => $validated['stock'],
            'price'      => $validated['price'],
            'modal'      => $validated['modal'],
            'profit'     => $profit,
            'margin'     => $margin,
            'description'=> $validated['description'] ?? null,
        ]);

        // Upload & crop produk jika ada
        if ($request->filled('crop_data')) {

            if (!str_starts_with($request->crop_data, 'data:image/png;base64,')) {
                abort(422, 'Invalid image format');
            }

            $image = str_replace('data:image/png;base64,', '', $request->crop_data);
            $image = str_replace(' ', '+', $image);

            $decoded = base64_decode($image);

            if (strlen($decoded) > 2 * 1024 * 1024) {
                abort(422, 'Image too large');
            }

            $filename = 'products/' . $product->id . '_' . time() . '.png';            

            Storage::disk('public')->put($filename, $decoded);

            $product->update([
                'image' => $filename
            ]);
        }

         return redirect()
            ->route('seller.product.index')
            ->with('success', 'Product successfully added.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('pages.seller.product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
         $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'       => 'required|string|max:255',
            'stock'       => 'required|integer|min:0',
            'price'       => 'required|numeric|min:0',
            'modal'       => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png|max:10240',
        ]);

        $profit = $validated['price'] - $validated['modal'];
        $margin = $validated['price'] > 0
            ? ($profit / $validated['price']) * 100
            : 0;

        $product->update([
            'category_id' => $validated['category_id'],
            'name'       => $validated['name'],
            'stock'       => $validated['stock'],
            'price'       => $validated['price'],
            'modal'       => $validated['modal'],
            'profit'      => $profit,
            'margin'      => $margin,
            'description' => $validated['description'] ?? null,
        ]);

        // Upload & crop produk jika ada
        if ($request->filled('crop_data')) {

            if (!str_starts_with($request->crop_data, 'data:image/png;base64,')) {
                abort(422, 'Invalid image format');
            }

            $image = str_replace('data:image/png;base64,', '', $request->crop_data);
            $image = str_replace(' ', '+', $image);

            $decoded = base64_decode($image);

            if (strlen($decoded) > 2 * 1024 * 1024) {
                abort(422, 'Image too large');
            }

            $filename = 'products/' . $product->id . '_' . time() . '.png';            

            Storage::disk('public')->put($filename, $decoded);

            $product->update([
                'image' => $filename
            ]);
        }

        return redirect()
            ->route('seller.product.index')
            ->with('success', 'Product successfully updated.');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // if ($category->products()->exists()) {
        //     return redirect()->route('admin.category.index')
        //         ->with('error', 'Cannot delete category with associated products.');
        // }

        $product->delete();
        return redirect()->route('seller.product.index')
            ->with('success', 'Category deleted successfully.');

    }
}
