<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        // Show up to 6 featured products on the homepage
        $featuredProducts = Product::with('category')
            ->where('status', 'active')
            ->where('stock_quantity', '>', 0)
            ->latest()
            ->take(6)
            ->get();

        return view('home', compact('featuredProducts'));
    }
}