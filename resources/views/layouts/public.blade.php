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
            <span class="hidden sm:inline">Call us: 0800-GVC-EGUSI</span>
        </div>
    </div>

    {{-- HEADER / NAVBAR --}}
    <header class="bg-white shadow-sm sticky top-0 z-40 border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex items-center justify-between h-16">

                {{-- LOGO --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2">
                    <div class="w-9 h-9 rounded-full bg-green-700 text-white flex items-center justify-center font-bold">G</div>
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
                <h3 class="text-white font-bold text-lg mb-3">Global Value Chain</h3>
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
                <h3 class="text-white font-bold mb-3">Contact</h3>
                <ul class="space-y-1 text-sm text-green-200">
                    <li>Email: info@gvc.com</li>
                    <li>Phone: 0800-GVC-EGUSI</li>
                    <li>Location: Lagos, Nigeria</li>
                </ul>
            </div>
        </div>
        <div class="border-t border-green-800">
            <div class="max-w-7xl mx-auto px-4 py-3 text-xs text-center text-green-300">
                &copy; {{ date('Y') }} Global Value Chain. All rights reserved.
            </div>
        </div>
    </footer>

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