<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function getProduct(Request $request) {
        $filterHeader = [
            'location' => [
                'Jakarta Utara',
                'Jakarta Selatan',
                'Jakarta Barat',
                'Jakarta Pusat',
                'Jakarta Timur',
            ],
            'category' => [
                'Food',
                'Drink',
                'Dessert',
                'Mix',
            ],
        ];

        $query = Product::query();

        if ($request->has('filters.location')) {
            $locations = $request->filters['location'];
            $query->whereHas('store', function ($q) use ($locations) {
                $q->whereIn('location', $locations);
            });
        }

        if ($request->has('filters.category')) {
            $categories = $request->filters['category'];
            $query->whereHas('category', function ($q) use ($categories) {
                $q->whereIn('category_name', $categories);
            });
        }

        if ($request->has('sort') && in_array($request->input('sort'), ['price_asc', 'price_desc'])) {
            $direction = $request->input('sort') === 'price_asc' ? 'asc' : 'desc';
            $query->orderBy('price', $direction);
        }

        $products = $query->get();
        return view('pages.listpage', compact('filterHeader', 'products'));
    }
}
