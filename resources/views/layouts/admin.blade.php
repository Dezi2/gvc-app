<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') — GVC Admin</title>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 min-h-screen font-sans antialiased">
    <div class="flex min-h-screen">

        {{-- SIDEBAR --}}
        <aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-30 w-64 bg-green-800 text-white transform -translate-x-full lg:translate-x-0 lg:static lg:inset-0 transition-transform duration-200">
            <div class="flex items-center justify-between p-4 border-b border-green-700">
                <div>
                    <h1 class="text-xl font-bold">GVC Admin</h1>
                    <p class="text-xs text-green-200">Global Value Chain</p>
                </div>
                <button id="close-sidebar" class="lg:hidden text-white text-2xl leading-none">&times;</button>
            </div>

            <nav class="p-4 space-y-1 text-sm">
                <a href="{{ route('admin.dashboard') }}"
                   class="block px-3 py-2 rounded hover:bg-green-700 {{ request()->routeIs('admin.dashboard') ? 'bg-green-700 font-semibold' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('admin.categories.index') }}"
                   class="block px-3 py-2 rounded hover:bg-green-700 {{ request()->routeIs('admin.categories.*') ? 'bg-green-700 font-semibold' : '' }}">
                    Categories
                </a>

                <a href="{{ route('admin.products.index') }}"
                   class="block px-3 py-2 rounded hover:bg-green-700 {{ request()->routeIs('admin.products.*') ? 'bg-green-700 font-semibold' : '' }}">
                    Products
                </a>

                <a href="{{ route('admin.orders.index') }}"
                   class="block px-3 py-2 rounded hover:bg-green-700 {{ request()->routeIs('admin.orders.*') ? 'bg-green-700 font-semibold' : '' }}">
                    Orders
                </a>

                <a href="{{ route('admin.processes.index') }}"
                   class="block px-3 py-2 rounded hover:bg-green-700 {{ request()->routeIs('admin.processes.*') ? 'bg-green-700 font-semibold' : '' }}">
                    Production Process
                </a>

                <a href="{{ route('admin.messages.index') }}"
                   class="flex items-center justify-between px-3 py-2 rounded hover:bg-green-700 {{ request()->routeIs('admin.messages.*') ? 'bg-green-700 font-semibold' : '' }}">
                    <span>Contact Messages</span>
                    @php
                        $unreadCount = \App\Models\ContactMessage::where('is_read', false)->count();
                    @endphp
                    @if ($unreadCount > 0)
                        <span class="bg-red-500 text-white text-xs font-bold rounded-full px-2 py-0.5">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </a>

                <div class="border-t border-green-700 pt-2 mt-2">
                    <a href="{{ route('home') }}" class="block px-3 py-2 rounded hover:bg-green-700">
                        View Public Site
                    </a>
                </div>
            </nav>
        </aside>

        {{-- Mobile overlay --}}
        <div id="sidebar-overlay" class="fixed inset-0 bg-black/50 z-20 hidden lg:hidden"></div>

        {{-- MAIN COLUMN --}}
        <div class="flex-1 flex flex-col min-w-0">

            {{-- TOP BAR --}}
            <header class="bg-white shadow-sm border-b border-gray-200">
                <div class="flex items-center justify-between px-4 py-3">
                    <div class="flex items-center gap-3">
                        <button id="open-sidebar" class="lg:hidden text-gray-700 text-2xl leading-none">&#9776;</button>
                        <h2 class="text-lg font-semibold text-gray-800">@yield('title', 'Dashboard')</h2>
                    </div>

                    <div class="flex items-center gap-4">
                        <span class="hidden sm:block text-sm text-gray-700">
                            Welcome, <strong>{{ auth()->user()->name }}</strong>
                        </span>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-sm px-3 py-1.5 rounded">
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            {{-- FLASH MESSAGES + CONTENT --}}
            <main class="flex-1 p-4 sm:p-6">
                @if (session('success'))
                    <div class="mb-4 bg-green-100 border border-green-400 text-green-800 px-4 py-3 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 bg-red-100 border border-red-400 text-red-800 px-4 py-3 rounded">
                        {{ session('error') }}
                    </div>
                @endif

                @yield('content')
            </main>

            <footer class="bg-white border-t border-gray-200 py-3 px-6 text-xs text-gray-500 text-center">
                &copy; {{ date('Y') }} Global Value Chain — Admin Panel
            </footer>
        </div>
    </div>

    {{-- Sidebar toggle script --}}
    <script>
        const sidebar  = document.getElementById('admin-sidebar');
        const overlay  = document.getElementById('sidebar-overlay');
        const openBtn  = document.getElementById('open-sidebar');
        const closeBtn = document.getElementById('close-sidebar');

        function openSidebar() {
            sidebar.classList.remove('-translate-x-full');
            overlay.classList.remove('hidden');
        }

        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }

        openBtn.addEventListener('click', openSidebar);
        closeBtn.addEventListener('click', closeSidebar);
        overlay.addEventListener('click', closeSidebar);
    </script>
</body>
</html>