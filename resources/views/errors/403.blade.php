@extends('layouts.public')

@section('title', 'Access Denied')

@section('content')

    <section class="bg-white py-20">
        <div class="max-w-3xl mx-auto px-4 text-center">

            <div class="text-8xl md:text-9xl font-bold text-red-600 mb-4">403</div>

            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                Access Denied
            </h1>

            <p class="text-gray-600 mb-8">
                You don't have permission to view this page.
                If you think this is a mistake, please log in with an account that has access.
            </p>

            <div class="flex flex-wrap items-center justify-center gap-3">
                <a href="{{ route('home') }}"
                   class="bg-green-700 hover:bg-green-800 text-white font-medium px-6 py-3 rounded transition">
                    Back to Home
                </a>

                @guest
                    <a href="{{ route('login') }}"
                       class="border-2 border-green-700 text-green-800 hover:bg-green-700 hover:text-white font-medium px-6 py-3 rounded transition">
                        Log In
                    </a>
                @endguest
            </div>

        </div>
    </section>

@endsection