<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Global Value Chain') — Fresh Nigerian Egusi</title>
    <meta name="description" content="Global Value Chain produces and sells premium Nigerian egusi, from our farms to your kitchen.">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="alternate icon" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white font-sans antialiased text-gray-800 flex flex-col min-h-screen">

    {{-- TOP BAR --}}
    <div class="bg-green-900 text-green-100 text-xs">
        <div class="max-w-7xl mx-auto px-4 py-2 flex items-center justify-between">
            <span>Fresh from our farms across Nigeria</span>
            <a href="tel:+2348033120273" class="hidden sm:inline hover:text-white transition">
                Call us: 08033120273
            </a>
        </div>
    </div>

    {{-- HEADER / NAVBAR --}}
    <header class="bg-white shadow-sm sticky top-0 z-40 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">

                {{-- LOGO --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="w-10 h-10 flex-shrink-0">
                        <defs>
                            <linearGradient id="gvcHeader" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#22c55e"/>
                                <stop offset="100%" stop-color="#15803d"/>
                            </linearGradient>
                        </defs>
                        <circle cx="50" cy="50" r="48" fill="url(#gvcHeader)"/>
                        <path d="M50 82 C 30 74 20 55 30 36 C 38 25 44 22 50 22 C 56 22 62 25 70 36 C 80 55 70 74 50 82 Z" fill="#ffffff"/>
                        <path d="M50 30 L50 76" stroke="#15803d" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                        <path d="M50 42 Q43 47 39 52 M50 42 Q57 47 61 52 M50 55 Q44 59 41 64 M50 55 Q56 59 59 64"
                              stroke="#15803d" stroke-width="1.8" stroke-linecap="round" fill="none"/>
                    </svg>
                    <div class="leading-tight">
                        <div class="font-bold text-green-800">Global Value Chain</div>
                        <div class="text-xs text-gray-500">Premium Nigerian Egusi</div>
                    </div>
                </a>

                {{-- DESKTOP NAV --}}
                <nav class="hidden md:flex items-center gap-1 text-sm font-medium">
                    <a href="{{ route('home') }}"
                       class="px-3 py-2 rounded hover:bg-green-50 hover:text-green-800 {{ request()->routeIs('home') ? 'text-green-800 font-semibold' : 'text-gray-700' }}">
                        Home
                    </a>
                    <a href="{{ route('about') }}"
                       class="px-3 py-2 rounded hover:bg-green-50 hover:text-green-800 {{ request()->routeIs('about') ? 'text-green-800 font-semibold' : 'text-gray-700' }}">
                        About Us
                    </a>
                    <a href="{{ route('products.index') }}"
                       class="px-3 py-2 rounded hover:bg-green-50 hover:text-green-800 {{ request()->routeIs('products.*') ? 'text-green-800 font-semibold' : 'text-gray-700' }}">
                        Our Products
                    </a>
                    <a href="{{ route('process.index') }}"
                       class="px-3 py-2 rounded hover:bg-green-50 hover:text-green-800 {{ request()->routeIs('process.*') ? 'text-green-800 font-semibold' : 'text-gray-700' }}">
                        How It's Made
                    </a>
                    <a href="{{ route('contact.index') }}"
                       class="px-3 py-2 rounded hover:bg-green-50 hover:text-green-800 {{ request()->routeIs('contact.*') ? 'text-green-800 font-semibold' : 'text-gray-700' }}">
                        Contact
                    </a>
                </nav>

                {{-- RIGHT SIDE: CART + AUTH --}}
                <div class="flex items-center gap-3">

                    {{-- CART --}}
                    <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-green-800">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.8">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span class="absolute -top-1 -right-2 bg-green-700 text-white text-[10px] font-bold rounded-full min-w-[16px] h-4 px-1 flex items-center justify-center">
                            {{ \App\Helpers\Cart::count() }}
                        </span>
                    </a>

                    {{-- DESKTOP AUTH --}}
                    @auth
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}"
                               class="hidden md:inline text-sm text-gray-700 hover:text-green-800">
                                Admin Panel
                            </a>
                        @else
                            <a href="{{ route('orders.index') }}"
                               class="hidden md:inline text-sm text-gray-700 hover:text-green-800 font-medium">
                                My Orders
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="hidden md:block">
                            @csrf
                            <button type="submit"
                                    class="text-sm bg-green-700 hover:bg-green-800 text-white px-3 py-1.5 rounded">
                                Log Out
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}"
                           class="hidden md:inline text-sm text-gray-700 hover:text-green-800">Login</a>
                        <a href="{{ route('register') }}"
                           class="hidden md:inline text-sm bg-green-700 hover:bg-green-800 text-white px-3 py-1.5 rounded">
                            Register
                        </a>
                    @endauth

                    {{-- MOBILE MENU BUTTON --}}
                    <button id="mobile-menu-btn" class="md:hidden text-gray-700 text-2xl leading-none">&#9776;</button>
                </div>
            </div>
        </div>

        {{-- MOBILE NAV --}}
        <nav id="mobile-menu" class="hidden md:hidden border-t border-gray-100 bg-white">
            <div class="px-4 py-3 flex flex-col gap-1">

                <a href="{{ route('home') }}" class="py-2 text-gray-700 hover:text-green-800">Home</a>
                <a href="{{ route('about') }}" class="py-2 text-gray-700 hover:text-green-800">About Us</a>
                <a href="{{ route('products.index') }}" class="py-2 text-gray-700 hover:text-green-800">Our Products</a>
                <a href="{{ route('process.index') }}" class="py-2 text-gray-700 hover:text-green-800">How It's Made</a>
                <a href="{{ route('contact.index') }}" class="py-2 text-gray-700 hover:text-green-800">Contact</a>

                <div class="border-t border-gray-100 mt-2 pt-3">
                    @auth
                        @if (auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="block py-2 text-green-800 font-semibold">
                                Admin Panel
                            </a>
                        @else
                            <a href="{{ route('orders.index') }}" class="block py-2 text-green-800 font-semibold">
                                My Orders
                            </a>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="mt-2">
                            @csrf
                            <button type="submit"
                                    class="w-full text-left bg-green-700 hover:bg-green-800 text-white px-3 py-2 rounded text-sm">
                                Log Out
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="block py-2 text-gray-700 font-medium">Login</a>
                        <a href="{{ route('register') }}"
                           class="block mt-2 bg-green-700 hover:bg-green-800 text-white px-3 py-2 rounded text-sm text-center font-medium">
                            Register
                        </a>
                    @endauth
                </div>
            </div>
        </nav>
    </header>

    {{-- PAGE CONTENT --}}
    <main class="flex-1">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="bg-green-900 text-green-100 mt-12">
        <div class="max-w-7xl mx-auto px-4 py-10 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <div class="flex items-center gap-2 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="w-8 h-8 flex-shrink-0">
                        <defs>
                            <linearGradient id="gvcFooter" x1="0%" y1="0%" x2="100%" y2="100%">
                                <stop offset="0%" stop-color="#22c55e"/>
                                <stop offset="100%" stop-color="#15803d"/>
                            </linearGradient>
                        </defs>
                        <circle cx="50" cy="50" r="48" fill="url(#gvcFooter)"/>
                        <path d="M50 82 C 30 74 20 55 30 36 C 38 25 44 22 50 22 C 56 22 62 25 70 36 C 80 55 70 74 50 82 Z" fill="#ffffff"/>
                        <path d="M50 30 L50 76" stroke="#15803d" stroke-width="2.5" stroke-linecap="round" fill="none"/>
                    </svg>
                    <h3 class="text-white font-bold text-lg">Global Value Chain</h3>
                </div>
                <p class="text-sm text-green-200">
                    From our farms to your kitchen — premium Nigerian egusi, produced with care and delivered fresh.
                </p>
            </div>

            <div>
                <h3 class="text-white font-bold mb-3">Quick Links</h3>
                <ul class="space-y-1 text-sm text-green-200">
                    <li><a href="{{ route('home') }}" class="hover:text-white">Home</a></li>
                    <li><a href="{{ route('about') }}" class="hover:text-white">About Us</a></li>
                    <li><a href="{{ route('products.index') }}" class="hover:text-white">Our Products</a></li>
                    <li><a href="{{ route('process.index') }}" class="hover:text-white">How It's Made</a></li>
                    <li><a href="{{ route('contact.index') }}" class="hover:text-white">Contact Us</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-bold mb-3">Get in Touch</h3>
                <ul class="space-y-2 text-sm text-green-200">
                    <li>
                        <a href="mailto:attu2000us@yahoo.com" class="flex items-center gap-2 hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            <span>attu2000us@yahoo.com</span>
                        </a>
                    </li>
                    <li>
                        <a href="tel:+2348033120273" class="flex items-center gap-2 hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>08033120273</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://wa.me/2348033120273" target="_blank" rel="noopener"
                           class="flex items-center gap-2 hover:text-white transition">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                            </svg>
                            <span>WhatsApp: 08033120273</span>
                        </a>
                    </li>
                    <li class="flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span>Abuja, Nigeria</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="border-t border-green-800">
            <div class="max-w-7xl mx-auto px-4 py-3 text-xs text-center text-green-300">
                &copy; {{ date('Y') }} Global Value Chain. All rights reserved.
            </div>
        </div>
    </footer>

    {{-- FLOATING WHATSAPP BUTTON --}}
    <a href="https://wa.me/2348033120273"
       target="_blank" rel="noopener"
       class="fixed bottom-6 left-6 z-40 w-14 h-14 rounded-full bg-[#25D366] hover:bg-[#1ebe5d] text-white shadow-lg flex items-center justify-center transition-all duration-300"
       aria-label="Chat on WhatsApp"
       title="Chat on WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="currentColor" viewBox="0 0 24 24">
            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
        </svg>
    </a>

    {{-- TOAST CONTAINER --}}
    <div id="toast-container" class="fixed bottom-20 right-6 z-50 space-y-2"></div>

    {{-- BACK TO TOP BUTTON --}}
    <button id="back-to-top"
            class="fixed bottom-6 right-6 z-40 w-11 h-11 rounded-full bg-green-700 hover:bg-green-800 text-white shadow-lg flex items-center justify-center opacity-0 pointer-events-none transition-all duration-300">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
        </svg>
    </button>

    {{-- SCRIPTS --}}
    <script>
        const btn  = document.getElementById('mobile-menu-btn');
        const menu = document.getElementById('mobile-menu');
        if (btn && menu) {
            btn.addEventListener('click', () => menu.classList.toggle('hidden'));
        }

        function showToast(message, type = 'success') {
            const container = document.getElementById('toast-container');
            const colors = type === 'success' ? 'bg-green-700 text-white' : 'bg-red-600 text-white';
            const toast = document.createElement('div');
            toast.className = `${colors} px-5 py-3 rounded shadow-lg flex items-center gap-3 min-w-[260px] max-w-[360px] transform transition-all duration-300 translate-x-full opacity-0`;
            toast.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                <span class="text-sm font-medium"></span>
            `;
            toast.querySelector('span').textContent = message;
            container.appendChild(toast);
            requestAnimationFrame(() => toast.classList.remove('translate-x-full', 'opacity-0'));
            setTimeout(() => {
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        @if (session('success')) showToast(@json(session('success')), 'success'); @endif
        @if (session('error'))   showToast(@json(session('error')), 'error');     @endif

        const backToTop = document.getElementById('back-to-top');
        if (backToTop) {
            window.addEventListener('scroll', () => {
                if (window.scrollY > 400) backToTop.classList.remove('opacity-0', 'pointer-events-none');
                else backToTop.classList.add('opacity-0', 'pointer-events-none');
            });
            backToTop.addEventListener('click', () => window.scrollTo({ top: 0, behavior: 'smooth' }));
        }
    </script>
</body>
</html>