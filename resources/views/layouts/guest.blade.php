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

    <div class="min-h-screen flex flex-col justify-center items-center px-4 py-8 sm:px-6 sm:py-12">

        {{-- BRANDED LOGO --}}
        <div class="flex flex-col items-center mb-6">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="w-14 h-14 flex-shrink-0">
                    <defs>
                        <linearGradient id="gvcGuest" x1="0%" y1="0%" x2="100%" y2="100%">
                            <stop offset="0%" stop-color="#22c55e"/>
                            <stop offset="100%" stop-color="#15803d"/>
                        </linearGradient>
                    </defs>
                    <circle cx="50" cy="50" r="48" fill="url(#gvcGuest)"/>
                    <path d="M50 82 C 30 74 20 55 30 36 C 38 25 44 22 50 22 C 56 22 62 25 70 36 C 80 55 70 74 50 82 Z" fill="#ffffff"/>
                    <path d="M50 30 L50 76" stroke="#15803d" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                    <path d="M50 42 Q43 47 39 52 M50 42 Q57 47 61 52 M50 55 Q44 59 41 64 M50 55 Q56 59 59 64"
                          stroke="#15803d" stroke-width="1.8" stroke-linecap="round" fill="none"/>
                </svg>
                <div class="leading-tight text-left">
                    <div class="font-bold text-green-800 text-lg">Global Value Chain</div>
                    <div class="text-xs text-gray-500">Premium Nigerian Egusi</div>
                </div>
            </a>
        </div>

        {{-- AUTH CARD --}}
        <div class="w-full max-w-md px-5 py-7 sm:px-6 sm:py-8 bg-white shadow-md overflow-hidden rounded-lg border border-gray-100">
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