<?php

namespace App\Http\Controllers;

use App\Helpers\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller
{
    // Show the checkout form
    public function checkout()
    {
        // If cart is empty, don't let them check out
        if (Cart::isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        // Validate stock before showing the form
        foreach (Cart::all() as $item) {
            $product = Product::find($item['id']);

            if (!$product || $product->stock_quantity < $item['quantity']) {
                Cart::remove($item['id']);
                return redirect()->route('cart.index')
                    ->with('error', 'Some items are no longer available and have been removed from your cart.');
            }
        }

        $user     = auth()->user();
        $items    = Cart::all();
        $subtotal = Cart::subtotal();

        return view('checkout.index', compact('user', 'items', 'subtotal'));
    }

    // Handle the checkout form submission
    public function placeOrder(Request $request)
    {
        // 1. Check cart isn't empty
        if (Cart::isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        // 2. Validate delivery info
        $validated = $request->validate([
            'full_name'        => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'email'            => 'required|email|max:255',
            'delivery_address' => 'required|string|max:500',
            'city'             => 'required|string|max:100',
            'state'            => 'required|string|max:100',
            'notes'            => 'nullable|string|max:1000',
        ]);

        // 3. Re-verify stock for every item
        foreach (Cart::all() as $item) {
            $product = Product::find($item['id']);

            if (!$product || $product->stock_quantity < $item['quantity']) {
                return redirect()->route('cart.index')
                    ->with('error', 'Sorry, stock changed for one of your items. Please review your cart.');
            }
        }

        // 4. Create the order inside a database transaction
        $order = DB::transaction(function () use ($validated) {
            $subtotal = Cart::subtotal();

            $order = Order::create([
                'user_id'          => auth()->id(),
                'order_number'     => $this->generateOrderNumber(),
                'total_amount'     => $subtotal,
                'status'           => 'pending',
                'full_name'        => $validated['full_name'],
                'phone'            => $validated['phone'],
                'email'            => $validated['email'],
                'delivery_address' => $validated['delivery_address'],
                'city'             => $validated['city'],
                'state'            => $validated['state'],
                'notes'            => $validated['notes'] ?? null,
            ]);

            // 5. Save each cart item as an order_item, and reduce stock
            foreach (Cart::all() as $item) {
                $order->items()->create([
                    'product_id'   => $item['id'],
                    'product_name' => $item['name'],
                    'price'        => $item['price'],
                    'quantity'     => $item['quantity'],
                    'subtotal'     => $item['price'] * $item['quantity'],
                ]);

                // Reduce product stock
                $product = Product::find($item['id']);
                if ($product) {
                    $product->decrement('stock_quantity', $item['quantity']);
                }
            }

            return $order;
        });

        // 6. Clear the cart
        Cart::clear();

        return redirect()->route('orders.show', $order)
            ->with('success', 'Order placed successfully! Your order number is ' . $order->order_number);
    }

    // List all orders for the logged-in customer
    public function index()
    {
        $orders = Order::with('items')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    // Show a single order (only if it belongs to the logged-in user)
    public function show(Order $order)
    {
        // Authorization: the customer can only see their own orders
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items');

        return view('orders.show', compact('order'));
    }

    // Generate a unique order number like "GVC-20260921-A3F7K"
    private function generateOrderNumber(): string
    {
        do {
            $number = 'GVC-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5));
        } while (Order::where('order_number', $number)->exists());

        return $number;
    }
}