<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Category;


class AdminController extends Controller
{
    public function index()
    {
        $totalSeller = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.name', 'seller')
            ->count();

        $totalBuyer = User::join('roles', 'users.role_id', '=', 'roles.id')
            ->where('roles.name', 'buyer')
            ->count();


        $totalCategories = Category::count();
        // $totalProduct = Product::count();

        return view('pages.admin.index', [
            'totalSeller'  => $totalSeller,
            'totalBuyer'   => $totalBuyer,
            'totalCategories' => $totalCategories,
            // 'totalProduct' => $totalProduct,
        ]);
    }
}
