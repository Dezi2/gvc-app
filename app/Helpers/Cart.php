<?php

namespace App\Helpers;

use App\Models\Product;

class Cart
{
    /**
     * Get all items currently in the cart.
     * Returns an array keyed by product ID.
     */
    public static function all(): array
    {
        return session()->get('cart', []);
    }

    /**
     * Add a product to the cart (or increase its quantity if already there).
     */
    public static function add(Product $product, int $quantity = 1): void
    {
        $cart = self::all();

        if (isset($cart[$product->id])) {
            // Product already in the cart — just bump the quantity
            $cart[$product->id]['quantity'] += $quantity;
        } else {
            // New product — add a fresh entry
            $cart[$product->id] = [
                'id'       => $product->id,
                'name'     => $product->name,
                'slug'     => $product->slug,
                'price'    => (float) $product->price,
                'image'    => $product->image,
                'quantity' => $quantity,
            ];
        }

        session()->put('cart', $cart);
    }

    /**
     * Update the quantity of an existing cart item.
     * If quantity is 0 or less, remove the item.
     */
    public static function update(int $productId, int $quantity): void
    {
        $cart = self::all();

        if (!isset($cart[$productId])) {
            return;
        }

        if ($quantity <= 0) {
            unset($cart[$productId]);
        } else {
            $cart[$productId]['quantity'] = $quantity;
        }

        session()->put('cart', $cart);
    }

    /**
     * Remove a product from the cart entirely.
     */
    public static function remove(int $productId): void
    {
        $cart = self::all();
        unset($cart[$productId]);
        session()->put('cart', $cart);
    }

    /**
     * Empty the cart.
     */
    public static function clear(): void
    {
        session()->forget('cart');
    }

    /**
     * Count total items — sum of every product's quantity.
     * Used to display the badge in the header.
     */
    public static function count(): int
    {
        $total = 0;
        foreach (self::all() as $item) {
            $total += $item['quantity'];
        }
        return $total;
    }

    /**
     * Calculate the subtotal of all items (price × quantity).
     */
    public static function subtotal(): float
    {
        $total = 0;
        foreach (self::all() as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }

    /**
     * Is the cart empty?
     */
    public static function isEmpty(): bool
    {
        return empty(self::all());
    }
}