@extends('layouts.public')

@section('title', 'Shopping Cart')

@section('content')

    {{-- PAGE HEADER --}}
    <section class="bg-green-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-10 md:py-12 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Shopping Cart</h1>
            <p class="text-green-100">Review your items before checkout.</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 py-10">

        @if (empty($items))
            {{-- EMPTY CART --}}
            <div class="text-center py-16 bg-gray-50 rounded-lg">
                <div class="w-20 h-20 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2 text-lg">Your cart is empty</h3>
                <p class="text-sm text-gray-500 mb-6">Add some products to get started.</p>
                <a href="{{ route('products.index') }}"
                   class="inline-block bg-green-700 hover:bg-green-800 text-white text-sm font-medium px-6 py-2.5 rounded">
                    Browse Products
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- ITEMS LIST --}}
                <div class="lg:col-span-2 space-y-3">
                    @foreach ($items as $item)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4 flex flex-col sm:flex-row items-start sm:items-center gap-4">

                            {{-- IMAGE --}}
                            <a href="{{ route('products.show', $item['slug']) }}"
                               class="flex-shrink-0">
                                @if ($item['image'])
                                    <img src="{{ asset('storage/' . $item['image']) }}"
                                         alt="{{ $item['name'] }}"
                                         class="w-20 h-20 object-cover rounded border border-gray-200">
                                @else
                                    <div class="w-20 h-20 bg-gray-100 rounded flex items-center justify-center text-[10px] text-gray-400">
                                        No image
                                    </div>
                                @endif
                            </a>

                            {{-- NAME + PRICE --}}
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('products.show', $item['slug']) }}"
                                   class="font-semibold text-gray-800 hover:text-green-800 block truncate">
                                    {{ $item['name'] }}
                                </a>
                                <p class="text-sm text-gray-500 mt-1">
                                    ₦{{ number_format($item['price'], 2) }} each
                                </p>
                            </div>

                            {{-- QUANTITY FORM --}}
                            <form action="{{ route('cart.update', $item['id']) }}" method="POST"
                                  class="flex items-center gap-2">
                                @csrf
                                @method('PATCH')
                                <label class="text-xs text-gray-500 sr-only">Qty</label>
                                <input type="number"
                                       name="quantity"
                                       value="{{ $item['quantity'] }}"
                                       min="0"
                                       max="99"
                                       class="w-16 border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-sm text-center">
                                <button type="submit"
                                        class="text-xs text-blue-600 hover:underline font-medium">
                                    Update
                                </button>
                            </form>

                            {{-- SUBTOTAL --}}
                            <div class="text-right w-24 flex-shrink-0">
                                <div class="font-semibold text-gray-800">
                                    ₦{{ number_format($item['price'] * $item['quantity'], 2) }}
                                </div>
                            </div>

                            {{-- REMOVE --}}
                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST"
                                  onsubmit="return confirm('Remove this item from your cart?');"
                                  class="flex-shrink-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="text-red-500 hover:text-red-700 p-2"
                                        title="Remove item">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach

                    {{-- CART ACTIONS --}}
                    <div class="flex items-center justify-between pt-4">
                        <a href="{{ route('products.index') }}"
                           class="text-sm text-green-700 hover:underline">
                            &larr; Continue Shopping
                        </a>

                        <form action="{{ route('cart.clear') }}" method="POST"
                              onsubmit="return confirm('Clear your entire cart?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="text-sm text-red-600 hover:underline">
                                Clear Cart
                            </button>
                        </form>
                    </div>
                </div>

                {{-- ORDER SUMMARY --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 sticky top-24">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">Order Summary</h2>

                        <div class="space-y-3 text-sm border-b border-gray-100 pb-4">
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Items</span>
                                <span class="font-medium text-gray-800">
                                    {{ \App\Helpers\Cart::count() }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium text-gray-800">
                                    ₦{{ number_format($subtotal, 2) }}
                                </span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-gray-600">Delivery</span>
                                <span class="text-xs text-gray-500 italic">Calculated at checkout</span>
                            </div>
                        </div>

                        <div class="flex items-center justify-between py-4">
                            <span class="font-semibold text-gray-800">Total</span>
                            <span class="text-xl font-bold text-green-800">
                                ₦{{ number_format($subtotal, 2) }}
                            </span>
                        </div>

                        @auth
                            <a href="{{ route('checkout.index') }}"
                               class="block w-full text-center bg-green-700 hover:bg-green-800 text-white font-medium py-3 rounded transition">
                                Proceed to Checkout
                            </a>
                        @else
                            <a href="{{ route('login') }}"
                               class="block w-full text-center bg-green-700 hover:bg-green-800 text-white font-medium py-3 rounded transition">
                                Log in to Checkout
                            </a>
                            <p class="text-xs text-gray-500 mt-2 text-center">
                                You need an account to place orders.
                            </p>
                        @endauth

                        <div class="mt-4 pt-4 border-t border-gray-100 text-xs text-gray-500 space-y-1">
                            <p>✓ Secure checkout</p>
                            <p>✓ Nationwide delivery</p>
                            <p>✓ Fresh from our farms</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

@endsection