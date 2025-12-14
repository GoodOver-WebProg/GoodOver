<?php

namespace App\Http\Controllers;

use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerProductController extends Controller {
    public function dashboard(Request $request) {
        $store = Store::where('user_id', Auth::id())->firstOrFail();

        $query = Product::query()->where('store_id', $store->id);

        if ($request->filled('q')) {
            $q = $request->input('q');
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'ILIKE', "%{$q}%")
                    ->orWhere('description', 'ILIKE', "%{$q}%");
            });
        }

        $sort = $request->input('sort', 'newest');
        if ($sort === 'price_asc') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_desc') {
            $query->orderBy('price', 'desc');
        } else {
            $query->latest(); 
        } 

        $products = $query->paginate(12)->withQueryString();

        $totalProduct = Product::where('store_id', $store->id)->count();
        $activeProduct = Product::where('store_id', $store->id)->where('status', 'active')->count();

        
        $totalSales = OrderItem::whereHas('order', function ($q) use ($store) {
            $q->where('store_id', $store->id)->where('status', 'finished');
        })->sum('quantity'); 


        return view('pages.seller.dashboard', compact(
            'store',
            'products',
            'sort',
            'totalProduct',
            'activeProduct',
            'totalSales'
        ));
    }
}
