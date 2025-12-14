<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Store;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

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

        $products = $query->where('status','active')->get();
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

    public function deleteProduct($id){

        $product = Product::findOrFail($id);

        if (!$product) {
            return redirect()->route('seller.dashboard')->with('error', __('product.delete_fail'));
        }

        $product->delete();
        return redirect()->route('seller.dashboard')->with('success', __('product.delete_success'));
    }

    public function addProduct(Request $request) {
        try {
            $rules = [
                'image_path' => 'required|file|mimes:jpg,jpeg,png|max:2048',
                'name' => 'required|string|max:255',
                'price' => 'required|integer|min:0',
                'description' => 'required|string',
                'status' => 'required|in:active,inactive',
                'total_quantity' => 'required|integer|min:0',
                'category_id' => 'required|exists:categories,id',
                'pickup_duration' => 'required|integer|min:1',
                'wizard_step' => 'nullable|integer',
            ];

            $messages = [
                'required'    => __('auth.Messages.required'),
                'mimes'       => __('auth.Messages.mimes'),
                'in'          => __('auth.Messages.in'),
                'max'         => __('auth.Messages.max'),
                'min'         => __('auth.Messages.min'),
                'integer'     => __('auth.Messages.integer'),
            ];

            $attributes = [
                'image_path'      => __('auth.attributes.product_image_path'),
                'name'            => __('auth.attributes.product_name'),
                'price'           => __('auth.attributes.product_price'),
                'description'     => __('auth.attributes.product_description'),
                'status'          => __('auth.attributes.product_status'),
                'total_quantity'  => __('auth.attributes.product_total_quantity'),
                'category_id'     => __('auth.attributes.product_category'),
                'pickup_duration' => __('auth.attributes.pickup_duration'),
            ];


            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated = $validator->validated();

            $store = Store::where('user_id', Auth::id())->firstOrFail();

            $file = $request->file('image_path');
            $dir = public_path('images/products');
            if (!is_dir($dir)) {
                mkdir($dir, 0755, true);
            }

            $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
            $file->move($dir, $filename);
            $relativePath = 'images/products/' . $filename;

            Product::create([
                'name' => $validated['name'],
                'price' => $validated['price'],
                'description' => $validated['description'],
                'store_id' => $store->id,
                'image_path' => $relativePath,
                'status' => $validated['status'],
                'total_quantity' => $validated['total_quantity'],
                'category_id' => $validated['category_id'],
                'pickup_duration' => $validated['pickup_duration'],
            ]);

            return redirect()->route('seller.dashboard')->with('success', __('product.create_success'));
        } catch (Exception $error) {
            return $error;
        }
    }

    public function getProductById($id) {
        $store = Store::where('user_id', Auth::id())->firstOrFail();
        $categories = Category::orderBy('category_name')->get();

        $product = Product::where('id', $id)
            ->where('store_id', $store->id)
            ->firstOrFail();
        
        return view('pages.seller.editproduct', compact('store', 'categories', 'product'));
    }
    public function editProduct(Request $request, $id) {
        try {
            $rules = [
                'image_path' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'name' => 'required|string|max:255',
                'price' => 'required|integer|min:0',
                'description' => 'required|string',
                'status' => 'required|in:active,inactive',
                'total_quantity' => 'required|integer|min:0',
                'category_id' => 'required|exists:categories,id',
                'pickup_duration' => 'required|integer|min:1',
            ];

            $messages = [
                'required' => __('auth.Messages.required'),
                'mimes'    => __('auth.Messages.mimes'),
                'in'       => __('auth.Messages.in'),
                'max'      => __('auth.Messages.max'),
                'min'      => __('auth.Messages.min'),
                'integer'  => __('auth.Messages.integer'),
            ];

            $attributes = [
                'image_path'      => __('auth.attributes.product_image_path'),
                'name'            => __('auth.attributes.product_name'),
                'price'           => __('auth.attributes.product_price'),
                'description'     => __('auth.attributes.product_description'),
                'status'          => __('auth.attributes.product_status'),
                'total_quantity'  => __('auth.attributes.product_total_quantity'),
                'category_id'     => __('auth.attributes.product_category'),
                'pickup_duration' => __('auth.attributes.pickup_duration'),
            ];

            $validator = Validator::make($request->all(), $rules, $messages, $attributes);

            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $validated = $validator->validated();

            $store = Store::where('user_id', Auth::id())->firstOrFail();

            $product = Product::where('id', $id)
                ->where('store_id', $store->id)
                ->firstOrFail();

            if ($request->hasFile('image_path')) {
                $file = $request->file('image_path');

                $dir = public_path('images/products');
                if (!is_dir($dir)) {
                    mkdir($dir, 0755, true);
                }

                $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
                $file->move($dir, $filename);
                $relativePath = 'images/products/' . $filename;

                $product->image_path = $relativePath;
            }

            $product->name = $validated['name'];
            $product->price = $validated['price'];
            $product->description = $validated['description'];
            $product->status = $validated['status'];
            $product->total_quantity = $validated['total_quantity'];
            $product->category_id = $validated['category_id'];
            $product->pickup_duration = $validated['pickup_duration'];

            $product->save();

            return redirect()->route('seller.dashboard')->with('success', __('product.update_success'));
        } catch (Exception $error) {
            return $error;
        }
    }
}
