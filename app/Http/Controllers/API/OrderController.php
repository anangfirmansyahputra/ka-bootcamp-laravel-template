<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function createOrder(Request $request)
    {
        $validate = $request->validate([
            'phone' => ['required', 'string'],
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => ['required', 'string', 'email'],
            'address' => ['required', 'string'],
            'city' => ['required', 'string'],
            'postal_code' => ['required', "string"],
            'country' => ['required', 'string'],
            'products' => ['required', 'array'],
            'products.*.product_variant_id' => ['required', 'exists:product_variants,id'],
            'products.*.quantity' => ['required', 'integer', 'min:1']
        ]);

        DB::beginTransaction();
        $user = $request->user();

        try {
            // Membuat order
            $order = Order::create([
                'user_id' => $user->id,
                'phone' => $request->phone,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'country' => $request->country,
                'status' => 'PENDING',
                'price' => 0
            ]);

            $totalPrice = 0;
            $orderProducts = [];

            foreach ($request->products as $product) {
                $productVariant = ProductVariant::find($product['product_variant_id']);

                if ($productVariant->stock < $product['quantity']) {
                    DB::rollBack();
                    return response()->json([
                        'data' => null,
                        'message' => "Stock untuk variant {$productVariant->variant_name} tidak mencukupi",
                        'success' => false
                    ], 400);
                }

                $productVariant->decrement('stock', $product['quantity']);

                $productPrice = $productVariant->product->price * $product['quantity'];
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
    }
}
