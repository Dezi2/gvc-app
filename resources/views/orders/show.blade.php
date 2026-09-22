@extends('layouts.public')

@section('title', 'Order ' . $order->order_number)

@section('content')

    {{-- PAGE HEADER --}}
    <section class="bg-green-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-8 md:py-10">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold">Order Details</h1>
                    <p class="text-green-100 text-sm mt-1 font-mono">{{ $order->order_number }}</p>
                </div>
                <a href="{{ route('orders.index') }}"
                   class="inline-block bg-white/10 hover:bg-white/20 border border-white/30 text-white text-sm px-4 py-2 rounded transition">
                    &larr; Back to My Orders
                </a>
            </div>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 py-10">

        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
            <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-5 flex items-start gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-700 flex-shrink-0 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    <h2 class="font-semibold text-green-800">Order placed successfully!</h2>
                    <p class="text-sm text-green-700 mt-1">{{ session('success') }}</p>
                    <p class="text-sm text-green-700 mt-1">We'll contact you shortly to confirm delivery.</p>
                </div>
            </div>
        @endif

        {{-- STATUS TRACKER --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 mb-6">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Order Status</h2>

            @php
                $statuses = ['pending', 'confirmed', 'processing', 'shipped', 'delivered'];
                $currentIndex = array_search($order->status, $statuses);
                if ($order->status === 'cancelled') $currentIndex = -1;
            @endphp

            @if ($order->status === 'cancelled')
                <div class="bg-red-50 border border-red-200 text-red-800 rounded-md px-4 py-3 text-sm">
                    This order was cancelled.
                </div>
            @else
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-0">
                    @foreach ($statuses as $index => $status)
                        <div class="flex items-center flex-1">
                            <div class="flex items-center gap-2 flex-shrink-0">
                                @if ($index <= $currentIndex)
                                    <div class="w-8 h-8 rounded-full bg-green-700 text-white flex items-center justify-center text-xs font-bold">
                                        ✓
                                    </div>
                                @else
                                    <div class="w-8 h-8 rounded-full bg-gray-200 text-gray-500 flex items-center justify-center text-xs font-bold">
                                        {{ $index + 1 }}
                                    </div>
                                @endif
                                <span class="text-xs font-medium {{ $index <= $currentIndex ? 'text-green-800' : 'text-gray-400' }} capitalize">
                                    {{ $status }}
                                </span>
                            </div>

                            @if (!$loop->last)
                                <div class="hidden sm:block flex-1 h-0.5 mx-2 {{ $index < $currentIndex ? 'bg-green-700' : 'bg-gray-200' }}"></div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT: ITEMS + DELIVERY --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- ITEMS --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100">
                        <h2 class="text-lg font-bold text-gray-800">Items Ordered</h2>
                    </div>

                    <div class="divide-y divide-gray-100">
                        @foreach ($order->items as $item)
                            <div class="px-6 py-4 flex items-center gap-4">
                                <div class="flex-1 min-w-0">
                                    <p class="font-medium text-gray-800">{{ $item->product_name }}</p>
                                    <p class="text-sm text-gray-500 mt-1">
                                        ₦{{ number_format($item->price, 2) }} × {{ $item->quantity }}
                                    </p>
                                </div>
                                <div class="text-right">
                                    <p class="font-semibold text-gray-800">
                                        ₦{{ number_format($item->subtotal, 2) }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="px-6 py-4 bg-gray-50 flex justify-between items-center">
                        <span class="font-semibold text-gray-700">Total</span>
                        <span class="text-xl font-bold text-green-800">
                            ₦{{ number_format($order->total_amount, 2) }}
                        </span>
                    </div>
                </div>

                {{-- DELIVERY INFORMATION --}}
                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Delivery Information</h2>

                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        <div>
                            <dt class="text-gray-500 text-xs uppercase tracking-wide mb-1">Full Name</dt>
                            <dd class="text-gray-800 font-medium">{{ $order->full_name }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500 text-xs uppercase tracking-wide mb-1">Phone</dt>
                            <dd class="text-gray-800 font-medium">{{ $order->phone }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-gray-500 text-xs uppercase tracking-wide mb-1">Email</dt>
                            <dd class="text-gray-800 font-medium">{{ $order->email }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-gray-500 text-xs uppercase tracking-wide mb-1">Address</dt>
                            <dd class="text-gray-800 font-medium">
                                {{ $order->delivery_address }}<br>
                                {{ $order->city }}, {{ $order->state }}
                            </dd>
                        </div>
                        @if ($order->notes)
                            <div class="sm:col-span-2">
                                <dt class="text-gray-500 text-xs uppercase tracking-wide mb-1">Notes</dt>
                                <dd class="text-gray-800">{{ $order->notes }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>

            {{-- RIGHT: ORDER INFO --}}
            <div class="lg:col-span-1 space-y-6">

                <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
                    <h2 class="text-lg font-bold text-gray-800 mb-4">Order Summary</h2>

                    <dl class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Order Number</dt>
                            <dd class="font-mono text-xs text-gray-800">{{ $order->order_number }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Order Date</dt>
                            <dd class="text-gray-800">{{ $order->created_at->format('M d, Y') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Items</dt>
                            <dd class="text-gray-800">{{ $order->items->sum('quantity') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Payment</dt>
                            <dd class="text-gray-800">
                                {{ strtoupper($order->payment_method ?? 'POD') }}
                            </dd>
                        </div>
                        <div class="flex justify-between pt-3 border-t border-gray-100">
                            <dt class="font-semibold text-gray-800">Total</dt>
                            <dd class="font-bold text-green-800 text-lg">
                                ₦{{ number_format($order->total_amount, 2) }}
                            </dd>
                        </div>
                    </dl>
                </div>

                <div class="bg-gray-50 rounded-lg border border-gray-100 p-6 text-sm">
                    <h3 class="font-semibold text-gray-800 mb-2">Need Help?</h3>
                    <p class="text-gray-600 mb-3">
                        Questions about your order? We're happy to help.
                    </p>
                    <ul class="text-xs text-gray-600 space-y-1">
                        <li>Email: attu2000us@yahoo.com</li>
                        <li>Phone: 08033120273</li>
                    </ul>
                </div>

                <a href="{{ route('products.index') }}"
                   class="block text-center bg-green-700 hover:bg-green-800 text-white font-medium py-3 rounded transition">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>

@endsection