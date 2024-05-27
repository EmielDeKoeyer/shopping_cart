<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\CartService;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct()
    {
        $this->cartService = new CartService();
    }


    public function listCart()
    {
        return response()->json([
            'cart' => $this->cartService->listCart()
        ]);
    }

    public function updateCart(Request $request){
        $this->validateRequest($request);
        $cart = $this->cartService->updateCart($request->all());
        if(!$cart){
            return response()->json(['success' => false, 'message' => 'Update cart failed']);
        }

        return response()->json(['success' => true, 'message' => 'Update cart successful']);
    }

    private function validateRequest(Request $request) {
        $request->validate([
            'product_id' => 'required|integer',
            'amount' => 'required|integer',
            'user_id' => 'required|integer'
        ]);
    }
}
