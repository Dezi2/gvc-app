@extends('layouts.public')

@section('title', 'My Orders')

@section('content')

    {{-- PAGE HEADER --}}
    <section class="bg-green-800 text-white">
        <div class="max-w-7xl mx-auto px-4 py-10 md:py-12">
            <h1 class="text-3xl md:text-4xl font-bold mb-2">My Orders</h1>
            <p class="text-green-100">Track your previous and current orders.</p>
        </div>
    </section>

    <div class="max-w-7xl mx-auto px-4 py-10">

        @if ($orders->isEmpty())
            <div class="text-center py-16 bg-gray-50 rounded-lg">
                <div class="w-20 h-20 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-800 mb-2 text-lg">You haven't placed any orders yet</h3>
                <p class="text-sm text-gray-500 mb-6">Once you place an order, it will appear here.</p>
                <a href="{{ route('products.index') }}"
                   class="inline-block bg-green-700 hover:bg-green-800 text-white text-sm font-medium px-6 py-2.5 rounded">
                    Start Shopping
                </a>
            </div>
        @else
            <div class="space-y-4">
                @foreach ($orders as $order)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                        <div class="p-5 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

                            {{-- LEFT: ORDER INFO --}}
                            <div class="flex-1">
                                <div class="flex flex-wrap items-center gap-3 mb-2">
                                    <span class="font-mono text-sm font-semibold text-gray-800">
                                        {{ $order->order_number }}
                                    </span>

                                    @php
                                        $statusColors = [
                                            'pending'    => 'bg-yellow-100 text-yellow-800',
                                            'confirmed'  => 'bg-blue-100 text-blue-800',
                                            'processing' => 'bg-indigo-100 text-indigo-800',
                                            'shipped'    => 'bg-purple-100 text-purple-800',
                                            'delivered'  => 'bg-green-100 text-green-800',
                                            'cancelled'  => 'bg-red-100 text-red-800',
                                        ];
                                        $color = $statusColors[$order->status] ?? 'bg-gray-100 text-gray-800';
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $color }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </div>

                                <div class="text-sm text-gray-600">
                                    Placed on {{ $order->created_at->format('M d, Y') }}
                                    · {{ $order->items->sum('quantity') }}
                                    {{ \Illuminate\Support\Str::plural('item', $order->items->sum('quantity')) }}
                                </div>
                            </div>

                            {{-- RIGHT: TOTAL + ACTION --}}
                            <div class="flex items-center gap-4 sm:flex-shrink-0">
                                <div class="text-right">
                                    <div class="text-xs text-gray-500">Total</div>
                                    <div class="font-bold text-green-800">
                                        ₦{{ number_format($order->total_amount, 2) }}
                                    </div>
                                </div>

                                <a href="{{ route('orders.show', $order) }}"
                                   class="text-sm bg-green-700 hover:bg-green-800 text-white font-medium px-4 py-2 rounded whitespace-nowrap">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8 flex justify-center">
                {{ $orders->links() }}
            </div>
        @endif
    </div>

@endsection