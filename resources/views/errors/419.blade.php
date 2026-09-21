@extends('layouts.public')

@section('title', 'Session Expired')

@section('content')

    <section class="bg-white py-20">
        <div class="max-w-3xl mx-auto px-4 text-center">

            <div class="w-24 h-24 mx-auto bg-yellow-100 rounded-full flex items-center justify-center mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>

            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">
                Session Expired
            </h1>

            <p class="text-gray-600 mb-8">
                Your page has been sitting idle for too long and the security token expired.
                Please refresh the page and try again.
            </p>

            <a href="javascript:window.location.reload()"
               class="inline-block bg-green-700 hover:bg-green-800 text-white font-medium px-6 py-3 rounded transition">
                Refresh Page
            </a>

        </div>
    </section>

@endsection