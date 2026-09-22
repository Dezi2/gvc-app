@extends('layouts.public')

@section('title', 'Home')

@section('content')

    {{-- HERO SECTION --}}
    <section class="bg-gradient-to-br from-green-700 via-green-800 to-green-900 text-white">
        <div class="max-w-7xl mx-auto px-4 py-16 md:py-24 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div>
                <span class="inline-block bg-green-600/40 text-green-100 text-xs font-semibold px-3 py-1 rounded-full mb-4">
                    Fresh from Nigerian Farms
                </span>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
                    Premium Egusi,<br>
                    <span class="text-green-300">From Farm to Your Kitchen</span>
                </h1>
                <p class="text-green-100 text-lg mb-8 max-w-lg">
                    Global Value Chain grows, harvests, processes, and packages authentic Nigerian egusi.
                    Order directly from us and taste the difference of farm-fresh quality.
                </p>
                <div class="flex flex-wrap gap-3">
                    <a href="{{ route('products.index') }}"
                       class="bg-white text-green-800 hover:bg-green-50 font-semibold px-6 py-3 rounded-md transition">
                        Shop Our Products
                    </a>
                    <a href="{{ route('about') }}"
                       class="border-2 border-white/60 hover:bg-white/10 text-white font-semibold px-6 py-3 rounded-md transition">
                        Learn More
                    </a>
                </div>
            </div>

            {{-- Decorative right column --}}
            <div class="hidden md:flex justify-center">
                <div class="w-80 h-80 rounded-full bg-green-600/30 flex items-center justify-center">
                    <div class="w-60 h-60 rounded-full bg-green-500/40 flex items-center justify-center">
                        <div class="w-40 h-40 rounded-full bg-green-400/60 flex items-center justify-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-20 h-20 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m0-18c3.5 0 6 2.5 6 6s-2.5 6-6 6-6-2.5-6-6 2.5-6 6-6z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- TRUST / FEATURES ROW --}}
    <section class="bg-green-50 border-b border-green-100">
        <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-center">

            <div>
                <div class="w-12 h-12 mx-auto bg-green-700 text-white rounded-full flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800">100% Natural</h3>
                <p class="text-sm text-gray-600 mt-1">No additives, no preservatives.</p>
            </div>

            <div>
                <div class="w-12 h-12 mx-auto bg-green-700 text-white rounded-full flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800">Farm Fresh</h3>
                <p class="text-sm text-gray-600 mt-1">Direct from our farms.</p>
            </div>

            <div>
                <div class="w-12 h-12 mx-auto bg-green-700 text-white rounded-full flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800">Hygienically Packaged</h3>
                <p class="text-sm text-gray-600 mt-1">Sealed for freshness.</p>
            </div>

            <div>
                <div class="w-12 h-12 mx-auto bg-green-700 text-white rounded-full flex items-center justify-center mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2" />
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800">Fast Delivery</h3>
                <p class="text-sm text-gray-600 mt-1">Nationwide shipping.</p>
            </div>
        </div>
    </section>

    {{-- FEATURED PRODUCTS --}}
    <section class="max-w-7xl mx-auto px-4 py-16">
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800">Our Products</h2>
            <p class="text-gray-600 mt-2 max-w-xl mx-auto">
                Explore our range of premium egusi products — freshly processed and ready for your next meal.
            </p>
        </div>

        @if ($featuredProducts->isEmpty())
            <div class="text-center py-12 bg-gray-50 rounded-lg">
                <p class="text-gray-500">No products available at the moment. Please check back soon.</p>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($featuredProducts as $product)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                        {{-- IMAGE --}}
                        <a href="{{ route('products.show', $product->slug) }}" class="block">
                            @if ($product->image)
                                <img src="{{ url('/img/products/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400 text-sm">
                                    No image
                                </div>
                            @endif
                        </a>

                        {{-- INFO --}}
                        <div class="p-4">
                            @if ($product->category)
                                <span class="inline-block text-xs font-medium text-green-700 bg-green-50 px-2 py-1 rounded mb-2">
                                    {{ $product->category->name }}
                                </span>
                            @endif

                            <h3 class="font-semibold text-gray-800 leading-tight">
                                <a href="{{ route('products.show', $product->slug) }}" class="hover:text-green-800">
                                    {{ $product->name }}
                                </a>
                            </h3>

                            <p class="text-sm text-gray-600 mt-1">
                                {{ \Illuminate\Support\Str::limit($product->description, 80) }}
                            </p>

                            <div class="flex items-center justify-between mt-4">
                                <span class="text-lg font-bold text-green-800">
                                    ₦{{ number_format($product->price, 2) }}
                                </span>
                                <a href="{{ route('products.show', $product->slug) }}"
                                   class="text-sm bg-green-700 hover:bg-green-800 text-white px-3 py-1.5 rounded">
                                    View
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('products.index') }}"
                   class="inline-block border-2 border-green-700 text-green-800 hover:bg-green-700 hover:text-white font-semibold px-6 py-3 rounded-md transition">
                    View All Products
                </a>
            </div>
        @endif
    </section>

    {{-- PROCESS TEASER --}}
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
            <div>
                <span class="text-xs font-semibold text-green-700 uppercase tracking-wider">Our Process</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2 mb-4">
                    From Seed to Shelf
                </h2>
                <p class="text-gray-600 mb-6">
                    Every bag of Global Value Chain egusi goes through a careful four-stage journey:
                    planting, harvesting, processing, and packaging. We control every step to guarantee
                    unmatched quality and freshness.
                </p>

                <ol class="space-y-3 text-sm">
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-green-700 text-white text-xs flex items-center justify-center flex-shrink-0 mt-0.5">1</span>
                        <span><strong class="text-gray-800">Planting &amp; Farming</strong> — we grow our melon seeds on carefully managed farms.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-green-700 text-white text-xs flex items-center justify-center flex-shrink-0 mt-0.5">2</span>
                        <span><strong class="text-gray-800">Harvesting</strong> — picked at peak ripeness for maximum flavour.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-green-700 text-white text-xs flex items-center justify-center flex-shrink-0 mt-0.5">3</span>
                        <span><strong class="text-gray-800">Processing</strong> — cleaned, dried, and ground using hygienic methods.</span>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-6 h-6 rounded-full bg-green-700 text-white text-xs flex items-center justify-center flex-shrink-0 mt-0.5">4</span>
                        <span><strong class="text-gray-800">Packaging</strong> — sealed in food-grade bags, ready for delivery.</span>
                    </li>
                </ol>
            </div>

            {{-- RIGHT CARD: Quality image --}}
            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-8 text-center">
                <div class="w-40 h-40 mx-auto rounded-full overflow-hidden border-4 border-green-100 mb-4">
                    <img src="{{ url('/img/home/quality.jpg') }}"
                         alt="Quality GVC Egusi"
                         class="w-full h-full object-cover">
                </div>
                <h3 class="font-bold text-gray-800 text-lg mb-2">Quality You Can Taste</h3>
                <p class="text-sm text-gray-600">
                    Our commitment to quality has made GVC egusi a trusted name in Nigerian kitchens.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA BANNER --}}
    <section class="bg-green-800 text-white">
        <div class="max-w-4xl mx-auto px-4 py-12 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-3">Ready to Order?</h2>
            <p class="text-green-100 mb-6">
                Get authentic Nigerian egusi delivered straight to your door.
            </p>
            <a href="{{ route('products.index') }}"
               class="inline-block bg-white text-green-800 hover:bg-green-100 font-semibold px-6 py-3 rounded-md transition">
                Browse Products
            </a>
        </div>
    </section>

@endsection