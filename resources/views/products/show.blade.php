@extends('layouts.public')

@section('title', $product->name)

@section('content')

    {{-- BREADCRUMB --}}
    <div class="bg-gray-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 py-3 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-green-800">Home</a>
            <span class="mx-1">/</span>
            <a href="{{ route('products.index') }}" class="hover:text-green-800">Products</a>
            @if ($product->category)
                <span class="mx-1">/</span>
                <a href="{{ route('products.index', ['category' => $product->category->slug]) }}"
                   class="hover:text-green-800">
                    {{ $product->category->name }}
                </a>
            @endif
            <span class="mx-1">/</span>
            <span class="text-gray-700">{{ $product->name }}</span>
        </div>
    </div>

    {{-- MAIN PRODUCT SECTION --}}
    <section class="max-w-7xl mx-auto px-4 py-10">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

            {{-- IMAGE --}}
            <div>
                <div class="bg-gray-100 rounded-lg overflow-hidden border border-gray-100">
                    @if ($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}"
                             alt="{{ $product->name }}"
                             class="w-full h-96 md:h-[500px] object-cover">
                    @else
                        <div class="w-full h-96 md:h-[500px] flex items-center justify-center text-gray-400">
                            No image available
                        </div>
                    @endif
                </div>
            </div>

            {{-- DETAILS --}}
            <div>
                @if ($product->category)
                    <a href="{{ route('products.index', ['category' => $product->category->slug]) }}"
                       class="inline-block text-xs font-medium text-green-700 bg-green-50 px-2 py-1 rounded mb-3">
                        {{ $product->category->name }}
                    </a>
                @endif

                <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
                    {{ $product->name }}
                </h1>

                {{-- PRICE --}}
                <div class="text-3xl font-bold text-green-800 mb-4">
                    ₦{{ number_format($product->price, 2) }}
                </div>

                {{-- STOCK STATUS --}}
                <div class="mb-6">
                    @if ($product->stock_quantity <= 0)
                        <span class="inline-block bg-red-100 text-red-700 text-sm font-medium px-3 py-1 rounded">
                            Out of Stock
                        </span>
                    @elseif ($product->stock_quantity < 10)
                        <span class="inline-block bg-yellow-100 text-yellow-800 text-sm font-medium px-3 py-1 rounded">
                            Only {{ $product->stock_quantity }} left in stock
                        </span>
                    @else
                        <span class="inline-block bg-green-100 text-green-800 text-sm font-medium px-3 py-1 rounded">
                            In Stock ({{ $product->stock_quantity }} available)
                        </span>
                    @endif
                </div>

                {{-- DESCRIPTION --}}
                <div class="mb-6">
                    <h3 class="font-semibold text-gray-800 mb-2">Description</h3>
                    <p class="text-gray-600 leading-relaxed whitespace-pre-line">
                        {{ $product->description }}
                    </p>
                </div>

                {{-- ADD TO CART --}}
                <div class="bg-gray-50 rounded-lg border border-gray-100 p-5">
                    @if ($product->stock_quantity > 0)
                        <form action="{{ route('cart.add', $product) }}" method="POST"
                              class="flex flex-col sm:flex-row items-stretch sm:items-end gap-3">
                            @csrf
                            <div class="flex-1">
                                <label for="quantity" class="block text-sm font-medium text-gray-700 mb-1">Quantity</label>
                                <input type="number"
                                       name="quantity"
                                       id="quantity"
                                       value="1"
                                       min="1"
                                       max="{{ $product->stock_quantity }}"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200">
                            </div>
                            <button type="submit"
                                    class="bg-green-700 hover:bg-green-800 text-white font-medium px-6 py-2.5 rounded transition">
                                Add to Cart
                            </button>
                        </form>
                        <p class="text-xs text-gray-500 mt-2">
                            {{ $product->stock_quantity }} available in stock.
                        </p>
                    @else
                        <button disabled
                                class="w-full bg-gray-300 text-gray-500 font-medium px-6 py-2.5 rounded cursor-not-allowed">
                            Out of Stock
                        </button>
                    @endif
                </div>

                {{-- EXTRA INFO --}}
                <div class="grid grid-cols-2 gap-3 mt-6 text-sm">
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-700 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-600">100% Natural</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-700 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-600">Hygienically Packaged</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-700 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-600">Farm Fresh</span>
                    </div>
                    <div class="flex items-start gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-700 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                        </svg>
                        <span class="text-gray-600">Nationwide Delivery</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- RELATED PRODUCTS --}}
    @if ($related->isNotEmpty())
        <section class="bg-gray-50 py-12">
            <div class="max-w-7xl mx-auto px-4">
                <h2 class="text-2xl font-bold text-gray-800 mb-6">You May Also Like</h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach ($related as $item)
                        <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                            <a href="{{ route('products.show', $item->slug) }}">
                                @if ($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}"
                                         alt="{{ $item->name }}"
                                         class="w-full h-40 object-cover">
                                @else
                                    <div class="w-full h-40 bg-gray-100 flex items-center justify-center text-gray-400 text-xs">
                                        No image
                                    </div>
                                @endif
                            </a>
                            <div class="p-3">
                                <h3 class="text-sm font-semibold text-gray-800 leading-tight">
                                    <a href="{{ route('products.show', $item->slug) }}" class="hover:text-green-800">
                                        {{ $item->name }}
                                    </a>
                                </h3>
                                <div class="text-green-800 font-bold mt-2 text-sm">
                                    ₦{{ number_format($item->price, 2) }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection