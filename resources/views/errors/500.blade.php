@extends('layouts.public')

@section('title', 'Something Went Wrong')

@section('content')

    <section class="bg-white py-20">
        <div class="max-w-3xl mx-auto px-4 text-center">

            <div class="text-8xl md:text-9xl font-bold text-yellow-600 mb-4">500</div>

            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                Something Went Wrong
            </h1>

            <p class="text-gray-600 mb-8">
                We're sorry — an unexpected error occurred on our end.
                Our team has been notified. Please try again in a moment.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('home') }}"
                   class="bg-green-700 hover:bg-green-800 text-white font-medium px-6 py-3 rounded transition">
                    Back to Home
                </a>
                <a href="{{ route('contact.index') }}"
                   class="border-2 border-green-700 text-green-800 hover:bg-green-700 hover:text-white font-medium px-6 py-3 rounded transition">
                    Contact Support
                </a>
            </div>

        </div>
    </section>

@endsection