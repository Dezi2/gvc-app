@extends('layouts.public')

@section('title', 'Contact Us')

@section('content')

    {{-- PAGE HEADER --}}
    <section class="bg-green-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-12 md:py-16 text-center">
            <h1 class="text-3xl md:text-4xl font-bold mb-3">Contact Us</h1>
            <p class="text-green-100 max-w-2xl mx-auto">
                Have a question, feedback, or a bulk order enquiry? We'd love to hear from you.
            </p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 py-12">

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- LEFT: CONTACT INFO --}}
            <div class="lg:col-span-1 space-y-4">

                {{-- EMAIL --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 flex items-start gap-4">
                    <div class="w-11 h-11 bg-green-100 text-green-800 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Email Us</h3>
                        <p class="text-sm text-gray-600">attu2000us@yahoo.com</p>
                    </div>
                </div>

                {{-- PHONE --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 flex items-start gap-4">
                    <div class="w-11 h-11 bg-green-100 text-green-800 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Call Us</h3>
                        <p class="text-sm text-gray-600">08033120273</p>
                        <p class="text-sm text-gray-600">Mon – Sat, 8am – 6pm</p>
                    </div>
                </div>

                {{-- LOCATION --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 flex items-start gap-4">
                    <div class="w-11 h-11 bg-green-100 text-green-800 rounded-full flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="font-semibold text-gray-800 mb-1">Visit Us</h3>
                        <p class="text-sm text-gray-600">Global Value Chain HQ</p>
                        <p class="text-sm text-gray-600">Abuja, Nigeria</p>
                    </div>
                </div>

                {{-- HOURS --}}
                <div class="bg-green-50 rounded-lg border border-green-100 p-6">
                    <h3 class="font-semibold text-gray-800 mb-2">Response Time</h3>
                    <p class="text-sm text-gray-600">
                        We typically respond within 24 hours on business days.
                        For urgent matters, please call us directly.
                    </p>
                </div>
            </div>

            {{-- RIGHT: CONTACT FORM --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 md:p-8">
                    <h2 class="text-xl font-bold text-gray-800 mb-1">Send Us a Message</h2>
                    <p class="text-sm text-gray-500 mb-6">
                        Fill in the form below and our team will get back to you as soon as possible.
                    </p>

                    <form action="{{ route('contact.send') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            {{-- NAME --}}
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Your Name <span class="text-red-600">*</span>
                                </label>
                                <input type="text"
                                       name="name"
                                       id="name"
                                       value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}"
                                       placeholder="e.g. Jane Doe"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- EMAIL --}}
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                    Email Address <span class="text-red-600">*</span>
                                </label>
                                <input type="email"
                                       name="email"
                                       id="email"
                                       value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}"
                                       placeholder="e.g. jane@example.com"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- SUBJECT --}}
                            <div class="md:col-span-2">
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">
                                    Subject <span class="text-red-600">*</span>
                                </label>
                                <input type="text"
                                       name="subject"
                                       id="subject"
                                       value="{{ old('subject') }}"
                                       placeholder="e.g. Bulk order enquiry"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('subject') border-red-500 @enderror">
                                @error('subject')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- MESSAGE --}}
                            <div class="md:col-span-2">
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">
                                    Message <span class="text-red-600">*</span>
                                </label>
                                <textarea name="message"
                                          id="message"
                                          rows="6"
                                          placeholder="Type your message here..."
                                          class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                                <p class="text-xs text-gray-500 mt-1">
                                    Please provide as much detail as possible. Minimum 10 characters.
                                </p>
                                @error('message')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- SUBMIT --}}
                        <div class="mt-6">
                            <button type="submit"
                                    class="bg-green-700 hover:bg-green-800 text-white font-medium px-6 py-3 rounded transition">
                                Send Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection