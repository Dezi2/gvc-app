<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Login') — Global Value Chain</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-gray-900 antialiased bg-gray-50">

    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

        {{-- BRANDED LOGO --}}
        <div class="flex flex-col items-center mb-6">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-12 h-12 rounded-full bg-green-700 text-white flex items-center justify-center font-bold text-xl">
                    G
                </div>
                <div class="leading-tight text-left">
                    <div class="font-bold text-green-800 text-lg">Global Value Chain</div>
                    <div class="text-xs text-gray-500">Premium Nigerian Egusi</div>
                </div>
            </a>
        </div>

        {{-- AUTH CARD --}}
        <div class="w-full sm:max-w-md px-6 py-8 bg-white shadow-md overflow-hidden sm:rounded-lg border border-gray-100">
            {{ $slot }}
        </div>

        {{-- BACK TO HOME LINK --}}
        <div class="mt-6 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-green-700">&larr; Back to Home</a>
        </div>

        {{-- FOOTER --}}
        <div class="mt-8 mb-6 text-xs text-gray-400 text-center">
            &copy; {{ date('Y') }} Global Value Chain. All rights reserved.
        </div>

    </div>
</body>
</html>