<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch active products with their categories
        $products = Product::with('category')
            ->where('status', 'active')
            ->get();

        return response()->json($products);
    }
}