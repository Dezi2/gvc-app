@extends('layouts.public')

@section('title', 'Page Not Found')

@section('content')

    <section class="bg-white py-20">
        <div class="max-w-3xl mx-auto px-4 text-center">

            <div class="text-8xl md:text-9xl font-bold text-green-700 mb-4">404</div>

            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                Page Not Found
            </h1>

            <p class="text-gray-600 mb-8">
                We couldn't find the page you were looking for.
                It may have been moved, deleted, or the URL might be incorrect.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('home') }}"
                   class="bg-green-700 hover:bg-green-800 text-white font-medium px-6 py-3 rounded transition">
                    Back to Home
                </a>
                <a href="{{ route('products.index') }}"
                   class="border-2 border-green-700 text-green-800 hover:bg-green-700 hover:text-white font-medium px-6 py-3 rounded transition">
                    Browse Products
                </a>
            </div>

        </div>
    </section>

@endsection