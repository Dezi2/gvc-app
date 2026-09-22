@extends('layouts.public')

@section('title', 'Our Products')

@section('content')

    {{-- PAGE HEADER --}}
    <section class="bg-green-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12 md:py-16 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">Our Products</h1>
            <p class="text-green-100 max-w-2xl mx-auto">
                Browse our full range of premium Nigerian egusi products — freshly processed and hygienically packaged.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 py-10">

        {{-- SEARCH + FILTER BAR --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-4 mb-6">
            <form method="GET" action="{{ route('products.index') }}"
                  class="grid grid-cols-1 md:grid-cols-3 gap-3">

                {{-- SEARCH --}}
                <div class="md:col-span-2">
                    <label for="search" class="block text-xs font-medium text-gray-600 mb-1">Search</label>
                    <input type="text"
                           name="search"
                           id="search"
                           value="{{ request('search') }}"
                           placeholder="Search products by name or description..."
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-sm">
                </div>

                {{-- CATEGORY FILTER --}}
                <div>
                    <label for="category" class="block text-xs font-medium text-gray-600 mb-1">Category</label>
                    <select name="category"
                            id="category"
                            class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 text-sm">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->slug }}"
                                {{ request('category') === $category->slug ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- ACTION BUTTONS --}}
                <div class="md:col-span-3 flex items-center gap-3">
                    <button type="submit"
                            class="bg-green-700 hover:bg-green-800 text-white text-sm font-medium px-5 py-2 rounded">
                        Apply Filters
                    </button>

                    @if (request()->filled('search') || request()->filled('category'))
                        <a href="{{ route('products.index') }}"
                           class="text-sm text-gray-600 hover:text-gray-900 underline">
                            Clear Filters
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- RESULTS HEADER --}}
        <div class="flex items-center justify-between mb-4">
            <p class="text-sm text-gray-600">
                Showing <strong>{{ $products->total() }}</strong>
                {{ \Illuminate\Support\Str::plural('product', $products->total()) }}
                @if (request('search'))
                    for "<strong>{{ request('search') }}</strong>"
                @endif
            </p>
        </div>

        {{-- PRODUCT GRID --}}
        @if ($products->isEmpty())
            <div class="text-center py-16 bg-gray-50 rounded-lg">
                <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-1">No products found</h3>
                <p class="text-sm text-gray-500 mb-4">Try adjusting your search or filters.</p>
                <a href="{{ route('products.index') }}"
                   class="inline-block bg-green-700 hover:bg-green-800 text-white text-sm px-5 py-2 rounded">
                    View All Products
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg hover:-translate-y-1 transition duration-300 flex flex-col">

                        {{-- IMAGE --}}
                        <a href="{{ route('products.show', $product->slug) }}" class="block relative">
                            @if ($product->image)
                                <div class="overflow-hidden">
                                    <img src="{{ url('/img/products/' . $product->image) }}"
                                         alt="{{ $product->name }}"
                                         class="w-full h-52 object-cover transition-transform duration-500 ease-out hover:scale-110">
                                </div>
                            @else
                                <div class="w-full h-52 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                                    No image
                                </div>
                            @endif

                            {{-- STOCK BADGE --}}
                            @if ($product->stock_quantity <= 0)
                                <span class="absolute top-2 right-2 bg-red-600 text-white text-xs font-semibold px-2 py-1 rounded">
                                    Out of Stock
                                </span>
                            @elseif ($product->stock_quantity < 10)
                                <span class="absolute top-2 right-2 bg-yellow-500 text-white text-xs font-semibold px-2 py-1 rounded">
                                    Low Stock
                                </span>
                            @endif
                        </a>

                        {{-- INFO --}}
                        <div class="p-4 flex flex-col flex-1">
                            @if ($product->category)
                                <span class="inline-block text-xs font-medium text-green-700 bg-green-50 px-2 py-1 rounded mb-2 self-start">
                                    {{ $product->category->name }}
                                </span>
                            @endif

                            <h3 class="font-semibold text-gray-800 leading-tight">
                                <a href="{{ route('products.show', $product->slug) }}" class="hover:text-green-800">
                                    {{ $product->name }}
                                </a>
                            </h3>

                            <p class="text-sm text-gray-600 mt-2 mb-4 flex-1">
                                {{ \Illuminate\Support\Str::limit($product->description, 90) }}
                            </p>

                            <div class="flex items-center justify-between mt-auto pt-3 border-t border-gray-100">
                                <span class="text-lg font-bold text-green-800">
                                    ₦{{ number_format($product->price, 2) }}
                                </span>
                                <a href="{{ route('products.show', $product->slug) }}"
                                   class="text-sm bg-green-700 hover:bg-green-800 text-white px-3 py-1.5 rounded transition">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- PAGINATION --}}
            <div class="mt-8 flex justify-center">
                {{ $products->links() }}
            </div>
        @endif
    </div>

@endsection