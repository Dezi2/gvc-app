@extends('layouts.public')

@section('title', 'Checkout')

@section('content')

    {{-- PAGE HEADER --}}
    <section class="bg-green-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-10 md:py-12">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">Checkout</h1>
            <p class="text-green-100">Almost there — just fill in your delivery details.</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 py-10">

        {{-- STEPS INDICATOR --}}
        <div class="hidden md:flex items-center justify-center gap-4 mb-8 text-sm">
            <div class="flex items-center gap-2 text-gray-400">
                <span class="w-7 h-7 rounded-full bg-green-700 text-white flex items-center justify-center font-semibold">1</span>
                <span>Cart</span>
            </div>
            <div class="w-12 h-0.5 bg-green-700"></div>
            <div class="flex items-center gap-2 text-green-800 font-semibold">
                <span class="w-7 h-7 rounded-full bg-green-700 text-white flex items-center justify-center font-semibold">2</span>
                <span>Delivery</span>
            </div>
            <div class="w-12 h-0.5 bg-gray-300"></div>
            <div class="flex items-center gap-2 text-gray-400">
                <span class="w-7 h-7 rounded-full bg-gray-300 text-white flex items-center justify-center font-semibold">3</span>
                <span>Confirmation</span>
            </div>
        </div>

        <form action="{{ route('checkout.place') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- LEFT: DELIVERY FORM --}}
                <div class="lg:col-span-2 space-y-5">

                    {{-- CONTACT INFORMATION --}}
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">Contact Information</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            {{-- FULL NAME --}}
                            <div>
                                <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Full Name <span class="text-red-600">*</span>
                                </label>
                                <input type="text"
                                       name="full_name"
                                       id="full_name"
                                       value="{{ old('full_name', $user->name) }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('full_name') border-red-500 @enderror">
                                @error('full_name')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- PHONE --}}
                            <div>
                                <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                                    Phone Number <span class="text-red-600">*</span>
                                </label>
                                <input type="text"
                                       name="phone"
                                       id="phone"
                                       value="{{ old('phone', $user->phone) }}"
                                       placeholder="e.g. 08012345678"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('phone') border-red-500 @enderror">
                                @error('phone')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- EMAIL --}}
                            <div class="md:col-span-2">
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                    Email Address <span class="text-red-600">*</span>
                                </label>
                                <input type="email"
                                       name="email"
                                       id="email"
                                       value="{{ old('email', $user->email) }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- DELIVERY ADDRESS --}}
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">Delivery Address</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            {{-- ADDRESS --}}
                            <div class="md:col-span-2">
                                <label for="delivery_address" class="block text-sm font-medium text-gray-700 mb-1">
                                    Street Address <span class="text-red-600">*</span>
                                </label>
                                <textarea name="delivery_address"
                                          id="delivery_address"
                                          rows="2"
                                          placeholder="House number, street, area..."
                                          class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('delivery_address') border-red-500 @enderror">{{ old('delivery_address', $user->address) }}</textarea>
                                @error('delivery_address')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- CITY --}}
                            <div>
                                <label for="city" class="block text-sm font-medium text-gray-700 mb-1">
                                    City <span class="text-red-600">*</span>
                                </label>
                                <input type="text"
                                       name="city"
                                       id="city"
                                       value="{{ old('city') }}"
                                       placeholder="e.g. Lagos"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('city') border-red-500 @enderror">
                                @error('city')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- STATE --}}
                            <div>
                                <label for="state" class="block text-sm font-medium text-gray-700 mb-1">
                                    State <span class="text-red-600">*</span>
                                </label>
                                <input type="text"
                                       name="state"
                                       id="state"
                                       value="{{ old('state') }}"
                                       placeholder="e.g. Lagos State"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('state') border-red-500 @enderror">
                                @error('state')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- NOTES --}}
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">Additional Notes</h2>

                        <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                            Order Notes <span class="text-gray-400 text-xs">(optional)</span>
                        </label>
                        <textarea name="notes"
                                  id="notes"
                                  rows="3"
                                  placeholder="Any special instructions for your delivery..."
                                  class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('notes') border-red-500 @enderror">{{ old('notes') }}</textarea>
                        @error('notes')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- RIGHT: ORDER SUMMARY --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 sticky top-24">
                        <h2 class="text-lg font-bold text-gray-800 mb-4">Your Order</h2>

                        {{-- ITEMS --}}
                        <div class="space-y-3 border-b border-gray-100 pb-4 max-h-72 overflow-y-auto">
                            @foreach ($items as $item)
                                <div class="flex items-center gap-3 text-sm">
                                    @if ($item['image'])
                                        <img src="{{ asset('images/products/' . $item['image']) }}"
                                             alt="{{ $item['name'] }}"
                                             class="w-12 h-12 rounded object-cover border border-gray-200 flex-shrink-0">
                                    @else
                                        <div class="w-12 h-12 bg-gray-100 rounded flex-shrink-0"></div>
                                    @endif

                                    <div class="flex-1 min-w-0">
                                        <p class="text-gray-800 font-medium truncate">{{ $item['name'] }}</p>
                                        <p class="text-gray-500 text-xs">
                                            {{ $item['quantity'] }} × ₦{{ number_format($item['price'], 2) }}
                                        </p>
                                    </div>

                                    <div class="text-gray-800 font-medium flex-shrink-0">
                                        ₦{{ number_format($item['price'] * $item['quantity'], 2) }}
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- TOTALS --}}
                        <div class="space-y-2 py-4 text-sm">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium text-gray-800">
                                    ₦{{ number_format($subtotal, 2) }}
                                </span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Delivery</span>
                                <span class="text-xs text-gray-500 italic">Paid on delivery</span>
                            </div>
                        </div>

                        <div class="flex justify-between items-center border-t border-gray-100 pt-4">
                            <span class="font-semibold text-gray-800">Total</span>
                            <span class="text-xl font-bold text-green-800">
                                ₦{{ number_format($subtotal, 2) }}
                            </span>
                        </div>

                        {{-- PLACE ORDER BUTTON --}}
                        <button type="submit"
                                class="mt-6 w-full bg-green-700 hover:bg-green-800 text-white font-medium py-3 rounded transition">
                            Place Order
                        </button>

                        <p class="text-xs text-gray-500 mt-3 text-center">
                            By placing your order, you agree to our terms and conditions.
                        </p>

                        <a href="{{ route('cart.index') }}"
                           class="block text-center text-sm text-green-700 hover:underline mt-4">
                            &larr; Back to Cart
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection