<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;

class ProductController extends Controller
{
    private ProductService $service;

    public function __construct()
    {
        $this->service = new ProductService();
    }

    public function listProducts(Request $request)
    {
        $search_term = $request->input('search_key', '');
        if(!$search_term) {
            return response()->json([
                'products' => $this->service->all()
            ]);
        }

        return response()->json([
            'products' => $this->service->filter($search_term)
        ]);
    }

    public function getProduct(Request $request)
    {
        $id = $request->route('id');
        return response()->json([
            'product' => $this->service->findById($id)
        ]);
    }
}
