<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    // Show the cart page
    public function index()
    {
        $items    = Cart::all();
        $subtotal = Cart::subtotal();

        return view('cart.index', compact('items', 'subtotal'));
    }

    // Add a product to the cart
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Prevent adding more than what's in stock
        if ($product->stock_quantity <= 0) {
            return back()->with('error', 'This product is out of stock.');
        }

        // Cap quantity at available stock
        $qty = min($request->quantity, $product->stock_quantity);

        Cart::add($product, $qty);

        return redirect()->route('cart.index')
            ->with('success', $product->name . ' added to cart.');
    }

    // Update a cart item's quantity
    public function update(Request $request, int $productId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:0',
        ]);

        Cart::update($productId, (int) $request->quantity);

        return redirect()->route('cart.index')
            ->with('success', 'Cart updated.');
    }

    // Remove a single item from the cart
    public function remove(int $productId)
    {
        Cart::remove($productId);

        return redirect()->route('cart.index')
            ->with('success', 'Item removed from cart.');
    }

    // Empty the entire cart
    public function clear()
    {
        Cart::clear();

        return redirect()->route('cart.index')
            ->with('success', 'Cart cleared.');
    }
}