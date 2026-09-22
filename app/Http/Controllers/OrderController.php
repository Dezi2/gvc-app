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
        if (Cart::isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

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
        if (Cart::isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'full_name'        => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'email'            => 'required|email|max:255',
            'delivery_address' => 'required|string|max:500',
            'city'             => 'required|string|max:100',
            'state'            => 'required|string|max:100',
            'notes'            => 'nullable|string|max:1000',
            'payment_method'   => 'required|in:pod,paystack,flutterwave',
        ]);

        // Re-verify stock for every item
        foreach (Cart::all() as $item) {
            $product = Product::find($item['id']);
            if (!$product || $product->stock_quantity < $item['quantity']) {
                return redirect()->route('cart.index')
                    ->with('error', 'Sorry, stock changed for one of your items. Please review your cart.');
            }
        }

        // Create the order inside a database transaction
        $order = DB::transaction(function () use ($validated) {
            $subtotal = Cart::subtotal();

            $order = Order::create([
                'user_id'          => auth()->id(),
                'order_number'     => $this->generateOrderNumber(),
                'total_amount'     => $subtotal,
                'status'           => 'pending',
                'payment_method'   => $validated['payment_method'],
                'payment_status'   => $validated['payment_method'] === 'pod' ? 'pending' : 'unpaid',
                'full_name'        => $validated['full_name'],
                'phone'            => $validated['phone'],
                'email'            => $validated['email'],
                'delivery_address' => $validated['delivery_address'],
                'city'             => $validated['city'],
                'state'            => $validated['state'],
                'notes'            => $validated['notes'] ?? null,
            ]);

            // Save each cart item as an order_item, and reduce stock
            foreach (Cart::all() as $item) {
                $order->items()->create([
                    'product_id'   => $item['id'],
                    'product_name' => $item['name'],
                    'price'        => $item['price'],
                    'quantity'     => $item['quantity'],
                    'subtotal'     => $item['price'] * $item['quantity'],
                ]);

                $product = Product::find($item['id']);
                if ($product) {
                    $product->decrement('stock_quantity', $item['quantity']);
                }
            }

            return $order;
        });

        // Clear the cart
        Cart::clear();

        // Redirect based on payment method
        $method = $validated['payment_method'];

        if ($method === 'pod') {
            return redirect()->route('orders.show', $order)
                ->with('success', 'Order placed successfully! You will pay on delivery.');
        }

        if ($method === 'paystack') {
            return redirect()->route('payment.paystack', $order);
        }

        if ($method === 'flutterwave') {
            return redirect()->route('payment.flutterwave', $order);
        }

        return redirect()->route('orders.show', $order);
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