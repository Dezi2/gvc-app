@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
    <div class="space-y-4">

        {{-- FILTER TABS --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-2 flex flex-wrap gap-1">
            @php
                $tabs = [
                    ''           => 'All',
                    'pending'    => 'Pending',
                    'confirmed'  => 'Confirmed',
                    'processing' => 'Processing',
                    'shipped'    => 'Shipped',
                    'delivered'  => 'Delivered',
                    'cancelled'  => 'Cancelled',
                ];
                $current = request('status', '');
            @endphp

            @foreach ($tabs as $value => $label)
                <a href="{{ route('admin.orders.index', $value ? ['status' => $value] : []) }}"
                   class="px-3 py-1.5 rounded text-sm font-medium transition
                          {{ $current === $value ? 'bg-green-700 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if ($orders->isEmpty())
                <div class="p-8 text-center text-gray-500">
                    No orders found{{ $current ? ' with this status' : '' }}.
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
                                <th class="text-left px-5 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
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
                                <tr class="border-t border-gray-100 hover:bg-gray-50">
                                    <td class="px-5 py-3 font-mono text-xs text-gray-800">
                                        {{ $order->order_number }}
                                    </td>
                                    <td class="px-5 py-3">
                                        <div class="font-medium text-gray-800">
                                            {{ $order->user->name ?? 'Guest' }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $order->user->email ?? '' }}
                                        </div>
                                    </td>
                                    <td class="px-5 py-3 font-medium text-gray-800">
                                        ₦{{ number_format($order->total_amount, 2) }}
                                    </td>
                                    <td class="px-5 py-3">
                                        <span class="px-2 py-1 rounded text-xs font-medium {{ $color }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3 text-gray-500">
                                        {{ $order->created_at->format('M d, Y') }}
                                    </td>
                                    <td class="px-5 py-3">
                                        <a href="{{ route('admin.orders.show', $order) }}"
                                           class="text-blue-600 hover:underline text-xs font-medium">
                                            View
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="px-5 py-4 border-t border-gray-200">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection