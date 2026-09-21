@extends('layouts.public')

@section('title', $process->title)

@section('content')

    {{-- BREADCRUMB --}}
    <div class="bg-gray-50 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 py-3 text-sm text-gray-500">
            <a href="{{ route('home') }}" class="hover:text-green-800">Home</a>
            <span class="mx-1">/</span>
            <a href="{{ route('process.index') }}" class="hover:text-green-800">How It's Made</a>
            <span class="mx-1">/</span>
            <span class="text-gray-700">{{ $process->title }}</span>
        </div>
    </div>

    {{-- PAGE HEADER --}}
    <section class="bg-green-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-10 md:py-14">
            <div class="flex items-center gap-4 mb-3">
                <div class="w-12 h-12 bg-white text-green-800 rounded-full flex items-center justify-center font-bold text-xl">
                    {{ $process->stage_order }}
                </div>
                <span class="text-green-100 text-sm font-medium uppercase tracking-wider">
                    Stage {{ $process->stage_order }}
                </span>
            </div>
            <h1 class="text-3xl md:text-4xl font-bold">{{ $process->title }}</h1>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 py-10">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

            {{-- LEFT: MAIN CONTENT --}}
            <div class="lg:col-span-2 space-y-8">

                {{-- IMAGE --}}
                @if ($process->image)
                    <div class="rounded-lg overflow-hidden shadow-sm border border-gray-100">
                        <img src="{{ asset('storage/' . $process->image) }}"
                             alt="{{ $process->title }}"
                             class="w-full h-80 md:h-[450px] object-cover">
                    </div>
                @else
                    <div class="w-full h-80 md:h-[400px] bg-gradient-to-br from-green-100 to-green-200 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-green-700/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                @endif

                {{-- DESCRIPTION --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 md:p-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-4">About This Stage</h2>
                    <p class="text-gray-700 leading-relaxed whitespace-pre-line">
                        {{ $process->description }}
                    </p>
                </div>

                {{-- PREVIOUS / NEXT NAVIGATION --}}
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                    {{-- PREVIOUS --}}
                    @if ($previous)
                        <a href="{{ route('process.show', $previous->slug) }}"
                           class="block bg-white rounded-lg shadow-sm border border-gray-100 p-5 hover:shadow-md hover:border-green-200 transition group">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-gray-100 group-hover:bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600 group-hover:text-green-800 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-xs text-gray-500 uppercase tracking-wider">Previous Stage</div>
                                    <div class="font-semibold text-gray-800 truncate">
                                        {{ $previous->title }}
                                    </div>
                                </div>
                            </div>
                        </a>
                    @else
                        <div class="hidden sm:block"></div>
                    @endif

                    {{-- NEXT --}}
                    @if ($next)
                        <a href="{{ route('process.show', $next->slug) }}"
                           class="block bg-white rounded-lg shadow-sm border border-gray-100 p-5 hover:shadow-md hover:border-green-200 transition group text-right">
                            <div class="flex items-center gap-3 justify-end">
                                <div class="min-w-0">
                                    <div class="text-xs text-gray-500 uppercase tracking-wider">Next Stage</div>
                                    <div class="font-semibold text-gray-800 truncate">
                                        {{ $next->title }}
                                    </div>
                                </div>
                                <div class="w-10 h-10 bg-gray-100 group-hover:bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600 group-hover:text-green-800 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                            </div>
                        </a>
                    @endif
                </div>
            </div>

            {{-- RIGHT: SIDEBAR --}}
            <div class="lg:col-span-1 space-y-6">

                {{-- ALL STAGES NAV --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                    <h3 class="font-bold text-gray-800 mb-4">The Full Process</h3>

                    <ol class="space-y-3 text-sm">
                        <li>
                            <a href="{{ route('process.index') }}"
                               class="text-green-700 hover:underline text-xs font-medium">
                                &larr; View all stages
                            </a>
                        </li>
                    </ol>

                    <div class="mt-2 border-t border-gray-100 pt-3">
                        {{-- Note: we only have current/previous/next in the controller,
                             so we can't loop through all here. Instead, show current stage context. --}}
                        <div class="flex items-center gap-3 py-2 px-3 bg-green-50 rounded-md">
                            <div class="w-8 h-8 bg-green-700 text-white rounded-full flex items-center justify-center text-xs font-bold flex-shrink-0">
                                {{ $process->stage_order }}
                            </div>
                            <div class="font-medium text-green-800">
                                {{ $process->title }}
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 mt-3 text-center">
                            You are viewing stage {{ $process->stage_order }} of the production process.
                        </p>
                    </div>
                </div>

                {{-- CTA --}}
                <div class="bg-green-800 text-white rounded-lg p-6 text-center">
                    <h3 class="font-bold text-lg mb-2">Ready to Order?</h3>
                    <p class="text-green-100 text-sm mb-4">
                        Experience the quality of GVC egusi in your kitchen.
                    </p>
                    <a href="{{ route('products.index') }}"
                       class="block bg-white text-green-800 hover:bg-green-100 font-medium py-2.5 rounded transition">
                        Browse Products
                    </a>
                </div>
            </div>
        </div>
    </div>

@endsection