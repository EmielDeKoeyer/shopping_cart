<?php

namespace App\Services;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartService
{
    public function listCart()
    {
        return Cart::where('user_id', Auth::id())
        ->join('products', 'products.id', '=', 'carts.product_id')
        ->select('carts.*', 'products.id', 'products.title', 'products.price', 'products.url')
        ->get();
    }

    public function updateCart($data)
    {
        if($data['amount'] <= 0) {
            return Cart::where('user_id', Auth::id())
            ->where('product_id', $data['product_id'])
            ->delete();
        }

        $cart = Cart::firstOrNew([
            'user_id' => Auth::id(),
            'product_id' => $data['product_id']
        ]);
    
        $cart->user_id = Auth::id();
        $cart->amount = $data['amount'];
        return $cart->save();
    }
}