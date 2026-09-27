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

            {{-- LEFT: CONTACT METHODS --}}
            <div class="lg:col-span-1 space-y-4">

                {{-- EMAIL --}}
                <a href="mailto:attu2000us@yahoo.com"
                   class="block bg-white rounded-lg shadow-sm border border-gray-100 p-6 hover:shadow-md hover:border-green-300 transition">
                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 bg-green-100 text-green-800 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="min-w-0">
                            <h3 class="font-semibold text-gray-800 mb-1">Email Us</h3>
                            <p class="text-sm text-gray-600 break-all">attu2000us@yahoo.com</p>
                            <p class="text-xs text-green-700 mt-2 font-medium">Click to send an email &rarr;</p>
                        </div>
                    </div>
                </a>

                {{-- PHONE --}}
                <a href="tel:+2348033120273"
                   class="block bg-white rounded-lg shadow-sm border border-gray-100 p-6 hover:shadow-md hover:border-green-300 transition">
                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 bg-green-100 text-green-800 rounded-full flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-1">Call Us</h3>
                            <p class="text-sm text-gray-600">08033120273</p>
                            <p class="text-xs text-green-700 mt-2 font-medium">Tap to call &rarr;</p>
                        </div>
                    </div>
                </a>

                {{-- WHATSAPP --}}
                <a href="https://wa.me/2348033120273" target="_blank" rel="noopener"
                   class="block bg-white rounded-lg shadow-sm border border-gray-100 p-6 hover:shadow-md hover:border-green-300 transition">
                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 bg-[#25D366] text-white rounded-full flex items-center justify-center flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-semibold text-gray-800 mb-1">WhatsApp Us</h3>
                            <p class="text-sm text-gray-600">08033120273</p>
                            <p class="text-xs text-green-700 mt-2 font-medium">Chat with us &rarr;</p>
                        </div>
                    </div>
                </a>

                {{-- LOCATION --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                    <div class="flex items-start gap-4">
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
                </div>

                {{-- RESPONSE TIME --}}
                <div class="bg-green-50 rounded-lg border border-green-100 p-6">
                    <h3 class="font-semibold text-gray-800 mb-2">Response Time</h3>
                    <p class="text-sm text-gray-600">
                        We typically respond within 24 hours on business days.
                        For urgent matters, please call or WhatsApp us directly.
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
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                                    Your Name <span class="text-red-600">*</span>
                                </label>
                                <input type="text" name="name" id="name"
                                       value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}"
                                       placeholder="e.g. Jane Doe"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('name') border-red-500 @enderror">
                                @error('name')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                                    Email Address <span class="text-red-600">*</span>
                                </label>
                                <input type="email" name="email" id="email"
                                       value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}"
                                       placeholder="e.g. jane@example.com"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('email') border-red-500 @enderror">
                                @error('email')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">
                                    Subject <span class="text-red-600">*</span>
                                </label>
                                <input type="text" name="subject" id="subject"
                                       value="{{ old('subject') }}"
                                       placeholder="e.g. Bulk order enquiry"
                                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('subject') border-red-500 @enderror">
                                @error('subject')
                                    <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="md:col-span-2">
                                <label for="message" class="block text-sm font-medium text-gray-700 mb-1">
                                    Message <span class="text-red-600">*</span>
                                </label>
                                <textarea name="message" id="message" rows="6"
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