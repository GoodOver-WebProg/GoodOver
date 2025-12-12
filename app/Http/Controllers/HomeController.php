<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        $isSearch = $request->has('q') && !empty($request->q);
        if ($isSearch) {
            $searchTerm = $request->q;
            $query->where(function ($q) use ($searchTerm) {
                $q->whereRaw('name ILIKE ?', ['%' . $searchTerm . '%'])
                    ->orWhereRaw('description ILIKE ?', ['%' . $searchTerm . '%']);
            });
        }

        // Order by updated_at desc (latest products)
        if ($isSearch) {
            $products = $query->orderBy('updated_at', 'desc')->paginate(12);
            $latestProducts = collect();
            $totalProducts = $products->total();
        } else {
            $totalProducts = $query->count();
            $latestProducts = $query->orderBy('updated_at', 'desc')
                ->limit(8)
                ->get();
            $products = null;
        }

        return view('pages.homepage', compact('latestProducts', 'products', 'totalProducts', 'isSearch'));
    }
}

