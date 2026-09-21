@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="space-y-6">

        {{-- STAT CARDS --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-green-600">
                <p class="text-sm text-gray-500">Total Products</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['total_products'] }}</p>
            </div>

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-blue-600">
                <p class="text-sm text-gray-500">Total Orders</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['total_orders'] }}</p>
            </div>

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-purple-600">
                <p class="text-sm text-gray-500">Total Customers</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['total_customers'] }}</p>
            </div>

            <div class="bg-white rounded-lg shadow p-5 border-l-4 border-yellow-500">
                <p class="text-sm text-gray-500">Pending Orders</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $stats['pending_orders'] }}</p>
            </div>

        </div>

        {{-- RECENT ORDERS --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="font-semibold text-gray-800">Recent Orders</h3>
                <a href="#" class="text-sm text-green-700 hover:underline">View All</a>
            </div>

            @if ($recentOrders->isEmpty())
                <div class="p-6 text-center text-gray-500">
                    No orders yet. They will appear here once customers start ordering.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="text-left px-5 py-3">Order #</th>
                                <th class="text-left px-5 py-3">Customer</th>
                                <th class="text-left px-5 py-3">Total</th>
                                <th class="text-left px-5 py-3">Status</th>
                                <th class="text-left px-5 py-3">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentOrders as $order)
                                <tr class="border-t border-gray-100">
                                    <td class="px-5 py-3 font-mono text-xs">{{ $order->order_number }}</td>
                                    <td class="px-5 py-3">{{ $order->user->name ?? 'Guest' }}</td>
                                    <td class="px-5 py-3">₦{{ number_format($order->total_amount, 2) }}</td>
                                    <td class="px-5 py-3">
                                        <span class="px-2 py-1 rounded text-xs bg-gray-200">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3 text-gray-500">
                                        {{ $order->created_at->format('M d, Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

    </div>
@endsection