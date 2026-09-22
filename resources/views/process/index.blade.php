@extends('layouts.public')

@section('title', 'How Egusi Is Made')

@section('content')

    {{-- PAGE HEADER --}}
    <section class="bg-green-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12 md:py-16 text-center">
            <span class="inline-block bg-green-600/40 text-green-100 text-xs font-semibold px-3 py-1 rounded-full mb-4">
                From Farm to Kitchen
            </span>
            <h1 class="text-3xl md:text-4xl font-bold mb-3">How Egusi Is Made</h1>
            <p class="text-green-100 max-w-2xl mx-auto">
                Take a journey through our value chain — from planting on our farms to the packaged egusi that reaches your kitchen.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 py-12">

        @if ($processes->isEmpty())
            {{-- EMPTY STATE --}}
            <div class="text-center py-16 bg-gray-50 rounded-lg">
                <div class="w-20 h-20 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v18m0-18c3.5 0 6 2.5 6 6s-2.5 6-6 6-6-2.5-6-6 2.5-6 6-6z" />
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2 text-lg">Production process coming soon</h3>
                <p class="text-sm text-gray-500">Check back shortly to see how our egusi is made.</p>
            </div>
        @else
            {{-- TIMELINE --}}
            <div class="space-y-16">

                @foreach ($processes as $index => $process)
                    @php
                        $isEven = $index % 2 === 0;
                    @endphp

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 md:gap-12 items-center">

                        {{-- IMAGE (alternates sides on desktop) --}}
                        <div class="{{ $isEven ? '' : 'md:order-2' }}">
                            <div class="relative">
                                {{-- Stage number badge --}}
                                <div class="absolute -top-4 -left-4 w-14 h-14 bg-green-700 text-white rounded-full flex items-center justify-center font-bold text-xl shadow-lg z-10">
                                    {{ $process->stage_order }}
                                </div>

                                {{-- Image or placeholder --}}
                                @if ($process->image)
                                    <img src="{{ asset('images/processes/' . $process->image) }}"
                                         alt="{{ $process->title }}"
                                         class="w-full h-72 md:h-96 object-cover rounded-lg shadow-md border border-gray-100">
                                @else
                                    <div class="w-full h-72 md:h-96 bg-gradient-to-br from-green-100 to-green-200 rounded-lg shadow-md flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-24 h-24 text-green-700/40" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- TEXT --}}
                        <div class="{{ $isEven ? '' : 'md:order-1' }}">
                            <span class="text-xs font-semibold text-green-700 uppercase tracking-wider">
                                Stage {{ $process->stage_order }}
                            </span>
                            <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mt-2 mb-4">
                                {{ $process->title }}
                            </h2>
                            <p class="text-gray-600 leading-relaxed mb-6 whitespace-pre-line">
                                {{ \Illuminate\Support\Str::limit($process->description, 240) }}
                            </p>

                            <a href="{{ route('process.show', $process->slug) }}"
                               class="inline-flex items-center gap-2 text-green-700 font-semibold hover:gap-3 transition-all">
                                Learn more about this stage
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>

            {{-- CTA --}}
            <div class="mt-20 bg-green-800 text-white rounded-lg">
                <div class="max-w-3xl mx-auto px-6 py-12 text-center">
                    <h2 class="text-2xl md:text-3xl font-bold mb-3">Taste the Difference</h2>
                    <p class="text-green-100 mb-6">
                        Quality you can trace from soil to shelf. Order our premium egusi today.
                    </p>
                    <a href="{{ route('products.index') }}"
                       class="inline-block bg-white text-green-800 hover:bg-green-100 font-semibold px-6 py-3 rounded-md transition">
                        Browse Products
                    </a>
                </div>
            </div>
        @endif
    </div>

@endsection