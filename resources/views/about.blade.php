@extends('layouts.public')

@section('title', 'About Us')

@section('content')

    {{-- PAGE HEADER --}}
    <section class="bg-green-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12 md:py-16 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">About Global Value Chain</h1>
            <p class="text-green-100 max-w-2xl mx-auto">
                A Nigerian egusi production company committed to quality, freshness, and value — from our farms to your kitchen.
            </p>
        </div>
    </section>

    {{-- WHO WE ARE --}}
    <section class="max-w-7xl mx-auto px-4 py-16 grid grid-cols-1 md:grid-cols-2 gap-10 items-center">
        <div>
            <span class="text-xs font-semibold text-green-700 uppercase tracking-wider">Who We Are</span>
            <h2 class="text-3xl font-bold text-gray-800 mt-2 mb-4">
                Rooted in Nigerian Soil, Trusted in Nigerian Kitchens
            </h2>
            <p class="text-gray-600 mb-4">
                Global Value Chain is a homegrown agricultural company dedicated to producing and supplying
                premium quality egusi (melon seeds) to families and businesses across Nigeria.
            </p>
            <p class="text-gray-600 mb-4">
                We are involved in every stage of the egusi value chain — from planting and harvesting on
                our farms, to careful processing, hygienic packaging, and delivering to your door.
            </p>
            <p class="text-gray-600">
                Our mission is simple: to give Nigerians access to authentic, high-quality egusi at fair
                prices, while supporting local farmers and sustainable agriculture.
            </p>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div class="bg-green-50 rounded-lg p-6 text-center">
                <div class="text-3xl font-bold text-green-800">100%</div>
                <div class="text-sm text-gray-600 mt-1">Natural Ingredients</div>
            </div>
            <div class="bg-green-50 rounded-lg p-6 text-center">
                <div class="text-3xl font-bold text-green-800">4</div>
                <div class="text-sm text-gray-600 mt-1">Production Stages</div>
            </div>
            <div class="bg-green-50 rounded-lg p-6 text-center">
                <div class="text-3xl font-bold text-green-800">100%</div>
                <div class="text-sm text-gray-600 mt-1">Quality Focused</div>
            </div>
            <div class="bg-green-50 rounded-lg p-6 text-center">
                <div class="text-3xl font-bold text-green-800">NG</div>
                <div class="text-sm text-gray-600 mt-1">Proudly Nigerian</div>
            </div>
        </div>
    </section>

    {{-- MISSION & VISION --}}
    <section class="bg-gray-50 py-16">
        <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-8">
                <div class="w-12 h-12 bg-green-700 text-white rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13 10V3L4 14h7v7l9-11h-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Our Mission</h3>
                <p class="text-gray-600">
                    To produce and deliver premium Nigerian egusi through a transparent, value-driven
                    process — empowering local farmers and delighting our customers with authenticity
                    in every package.
                </p>
            </div>

            <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-8">
                <div class="w-12 h-12 bg-green-700 text-white rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Our Vision</h3>
                <p class="text-gray-600">
                    To become the most trusted egusi brand in Nigeria — a household name synonymous with
                    quality, transparency, and fair value across the entire production chain.
                </p>
            </div>
        </div>
    </section>

    {{-- OUR VALUES --}}
    <section class="max-w-7xl mx-auto px-4 py-16">
        <div class="text-center mb-10">
            <span class="text-xs font-semibold text-green-700 uppercase tracking-wider">Our Values</span>
            <h2 class="text-3xl font-bold text-gray-800 mt-2">What Drives Us</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

            <div class="bg-white rounded-lg border border-gray-100 p-6 hover:shadow-md transition">
                <div class="w-11 h-11 bg-green-100 text-green-800 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Quality</h3>
                <p class="text-sm text-gray-600">
                    Every bag of egusi passes strict quality checks before it reaches you.
                </p>
            </div>

            <div class="bg-white rounded-lg border border-gray-100 p-6 hover:shadow-md transition">
                <div class="w-11 h-11 bg-green-100 text-green-800 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Community</h3>
                <p class="text-sm text-gray-600">
                    We work with local farmers and support sustainable Nigerian agriculture.
                </p>
            </div>

            <div class="bg-white rounded-lg border border-gray-100 p-6 hover:shadow-md transition">
                <div class="w-11 h-11 bg-green-100 text-green-800 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2">Transparency</h3>
                <p class="text-sm text-gray-600">
                    We openly share how our egusi is grown, processed, and packaged.
                </p>
            </div>

        </div>
    </section>

    {{-- CTA --}}
    <section class="bg-green-800 text-white">
        <div class="max-w-4xl mx-auto px-4 py-12 text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-3">Taste the GVC Difference</h2>
            <p class="text-green-100 mb-6">
                Order our premium egusi and experience farm-fresh quality in your kitchen.
            </p>
            <a href="{{ route('products.index') }}"
               class="inline-block bg-white text-green-800 hover:bg-green-100 font-semibold px-6 py-3 rounded-md transition">
                Browse Products
            </a>
        </div>
    </section>

@endsection