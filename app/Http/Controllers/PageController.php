<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function homepage()
    {
        return view('pages.homepage');
    }

    public function detailPage()
    {
        return view('pages.detailpage');
    }

    public function userRegister()
    {
        return view('pages.register');
    }

    public function sellerRegister()
    {
        return view('pages.seller.register');
    }
    public function sellerAddProduct() 
    {
        $store = Store::where('user_id', Auth::id())->first();
        $categories = Category::orderBy('category_name')->get();

        return view('pages.seller.addproduct', compact('store', 'categories'));
    }
}
