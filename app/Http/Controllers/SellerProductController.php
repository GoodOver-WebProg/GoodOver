<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function manageOrder(Request $request) {
        $store = Store::where('user_id', Auth::id())->firstOrFail();

        $pendingOrders = Order::where('store_id', $store->id)
            ->where('status', 'pending')
            ->with(['items.product']) 
            ->get();

        foreach ($pendingOrders as $order) {
            $item = $order->items->first();
            $product = $item?->product;

            if (!$order->created_at || !$product) {
                continue;
            }

            $deadline = $order->created_at->copy()->addMinutes((int) $product->pickup_duration);

            if (now()->greaterThan($deadline)) {
                $order->update(['status' => 'cancelled']);
                Product::where('id', $product->id)
                    ->lockForUpdate()
                    ->first()
                    ->increment('total_quantity', $item->quantity);
            }
        }

        $filter = $request->input('filter', 'pending'); // pending|finished|cancelled|all
        $sort   = $request->input('sort', 'oldest');    // oldest|latest

        $query = Order::query()
            ->where('store_id', $store->id)
            ->with(['user', 'items.product']);

        // Filter
        if ($filter === 'pending') {
            $query->where('status', 'pending');
        } elseif ($filter === 'finished') {
            $query->where('status', 'finished');
        } elseif ($filter === 'cancelled') {
            $query->where('status', 'cancelled');
        }

        // Sort
        $sort === 'latest'
            ? $query->orderByDesc('created_at')
            : $query->orderBy('created_at');

        $orders = $query->paginate(12)->withQueryString();

        return view('pages.seller.manageorder', compact('store', 'orders', 'filter', 'sort'));
    }

    public function updateOrder($id) {
        $store = Store::where('user_id', Auth::id())->firstOrFail();

        return DB::transaction(function () use ($store, $id) {
            $order = Order::where('store_id', $store->id)
                ->lockForUpdate()
                ->findOrFail($id);

            if ($order->status !== 'pending') {
                return back()->with('error', __('sellerOrder.pending_order_error'));
            }

            $items = $order->items()->get();

            foreach ($items as $item) {
                $product = Product::where('id', $item->product_id)
                    ->lockForUpdate()
                    ->firstOrFail();

                if ($item->quantity > $product->total_quantity) {
                    return back()->with('error', __('product.quantity_exceeds_stock', [
                        'available' => $product->total_quantity
                    ]));
                }

                $product->decrement('total_quantity', (int) $item->quantity);
            }

            $order->update(['status' => 'finished']);

            return back()->with('success', __('sellerOrder.finish_update_order'));
        });
    }
}
