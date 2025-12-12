<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class ProductController extends Controller {
    public function getProduct(Request $request) {
        $filterHeader = [
            'location' => [
                'label' => __('filters.location'),
                'options' => [
                    ['value' => 'Jakarta Utara', 'label' => __('filters.locations.jakarta_utara')],
                    ['value' => 'Jakarta Selatan', 'label' => __('filters.locations.jakarta_selatan')],
                    ['value' => 'Jakarta Barat', 'label' => __('filters.locations.jakarta_barat')],
                    ['value' => 'Jakarta Timur', 'label' => __('filters.locations.jakarta_timur')],
                    ['value' => 'Jakarta Pusat', 'label' => __('filters.locations.jakarta_pusat')],
                ],
            ],
            'category' => [
                'label' => __('filters.category'),
                'options' => [
                    ['value' => 'Makanan', 'label' => __('filters.categories.food')],
                    ['value' => 'Minuman', 'label' => __('filters.categories.drink')],
                    ['value' => 'Makanan Penutup', 'label' => __('filters.categories.dessert')],
                    ['value' => 'Campuran', 'label' => __('filters.categories.mix')],
                ],
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

    public function show($id)
    {
        $product = Product::find($id);

        if (!$product) {
            return redirect()->route('home')->with('error', __('product.not_found'));
        }

        return view('pages.detailpage', compact('product'));
    }
}
