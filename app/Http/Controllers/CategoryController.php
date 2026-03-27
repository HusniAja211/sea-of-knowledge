<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    //Autorisasi hak pengelolaan category berbasis Role (admin)
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Category::class, 'category');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->paginate(5);

        return view('pages.admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $request->validate([
            'name' => 'required|string|max:50|unique:categories,name',
        ],
        [
            'name.unique' => 'Category name already exists.',
            'name.required' => 'Category name is required.',
        ]
        );

        Category::create($request->all());
        return redirect()->route('admin.category.index')
            ->with('success', 'Category Creates Successfully');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('pages.admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:50'
        ],
        [
            'name.unique' => 'Category name already exists.',
        ]);

        $category->update($request->all());

         return redirect()->route('admin.category.index')
            ->with('success', 'Category updated successfully.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        // if ($category->products()->exists()) {
        //     return redirect()->route('admin.category.index')
        //         ->with('error', 'Cannot delete category with associated products.');
        // }

        $category->delete();
        return redirect()->route('admin.category.index')
            ->with('success', 'Category deleted successfully.');
    }
}
