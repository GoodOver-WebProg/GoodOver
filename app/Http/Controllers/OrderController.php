<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class OrderController extends Controller
{
  public function reserve(Request $request)
  {
    try {
      $validator = Validator::make($request->all(), [
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1',
      ], [
        'product_id.required' => __('product.product_id_required'),
        'product_id.exists' => __('product.product_not_found'),
        'quantity.required' => __('product.quantity_required'),
        'quantity.integer' => __('product.quantity_invalid'),
        'quantity.min' => __('product.quantity_min'),
      ]);

      if ($validator->fails()) {
        return response()->json([
          'success' => false,
          'message' => $validator->errors()->first()
        ], 422);
      }

      if (!Auth::check()) {
        return response()->json([
          'success' => false,
          'message' => __('product.login_required')
        ], 401);
      }

      $productId = $request->product_id;
      $quantity = $request->quantity;

      return DB::transaction(function () use ($productId, $quantity) {
        $product = Product::lockForUpdate()->find($productId);

        if (!$product) {
          return response()->json([
            'success' => false,
            'message' => __('product.product_not_found')
          ], 404);
        }

        if ($product->status !== 'active' && $product->status !== 'best_seller') {
          return response()->json([
            'success' => false,
            'message' => __('product.product_not_available')
          ], 400);
        }

        if ($quantity > $product->total_quantity) {
          return response()->json([
            'success' => false,
            'message' => __('product.quantity_exceeds_stock', ['available' => $product->total_quantity])
          ], 400);
        }

        $userId = Auth::id();

        $activeOrder = Order::where('user_id', $userId)
          ->whereNotIn('status', ['finished', 'cancelled'])
          ->first();

        if ($activeOrder) {
          return response()->json([
            'success' => false,
            'message' => __('product.active_order_exists', ['order_number' => $activeOrder->order_number])
          ], 400);
        }

        $storeId = $product->store_id;
        $price = $product->price;
        $totalPrice = $price * $quantity;

        $date = now();
        $dayMonth = $date->format('d') . $date->format('m');
        $random = str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT);
        $orderNumber = 'GO-' . $dayMonth . '-' . $storeId . '-' . $userId . '-' . $random;

        $order = Order::create([
          'user_id' => $userId,
          'store_id' => $storeId,
          'status' => 'pending',
          'order_number' => $orderNumber,
          'total_price' => $totalPrice,
        ]);

        OrderItem::create([
          'order_id' => $order->id,
          'product_id' => $productId,
          'quantity' => $quantity,
          'unit_price' => $price,
        ]);

        return response()->json([
          'success' => true,
          'message' => __('product.reserve_success', ['order_number' => $orderNumber]),
          'order_number' => $orderNumber,
          'order_id' => $order->id,
        ], 200);
      });
    } catch (\Exception $e) {
      return response()->json([
        'success' => false,
        'message' => __('product.reserve_failed') . ': ' . $e->getMessage()
      ], 500);
    }
  }
}

