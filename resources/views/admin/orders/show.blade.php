@extends('layouts.admin')

@section('title', 'Order ' . $order->order_number)

@section('content')
    <div class="space-y-6">

        {{-- BACK LINK --}}
        <a href="{{ route('admin.orders.index') }}"
           class="text-sm text-green-700 hover:underline">
            &larr; Back to Orders
        </a>

        {{-- HEADER: ORDER # + STATUS --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h2 class="text-xl font-bold text-gray-800 font-mono">{{ $order->order_number }}</h2>
                <p class="text-sm text-gray-500 mt-1">
                    Placed on {{ $order->created_at->format('M d, Y \a\t h:i A') }}
                </p>
            </div>

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
            <span class="inline-block px-3 py-1.5 rounded text-sm font-semibold {{ $color }}">
                {{ ucfirst($order->status) }}
            </span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT: ITEMS + DELIVERY --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- ITEMS --}}
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-800">Items Ordered</h3>
                    </div>

                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="text-left px-5 py-3">Product</th>
                                <th class="text-left px-5 py-3">Price</th>
                                <th class="text-left px-5 py-3">Qty</th>
                                <th class="text-right px-5 py-3">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr class="border-t border-gray-100">
                                    <td class="px-5 py-3 font-medium text-gray-800">
                                        {{ $item->product_name }}
                                    </td>
                                    <td class="px-5 py-3 text-gray-600">
                                        ₦{{ number_format($item->price, 2) }}
                                    </td>
                                    <td class="px-5 py-3 text-gray-600">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="px-5 py-3 text-right font-medium text-gray-800">
                                        ₦{{ number_format($item->subtotal, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="bg-gray-50">
                            <tr>
                                <td colspan="3" class="px-5 py-3 text-right font-semibold text-gray-700">
                                    Total
                                </td>
                                <td class="px-5 py-3 text-right font-bold text-green-800">
                                    ₦{{ number_format($order->total_amount, 2) }}
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                {{-- DELIVERY INFORMATION --}}
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Delivery Information</h3>

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
                                <dt class="text-gray-500 text-xs uppercase tracking-wide mb-1">Customer Notes</dt>
                                <dd class="text-gray-800">{{ $order->notes }}</dd>
                            </div>
                        @endif
                    </dl>
                </div>
            </div>

            {{-- RIGHT: UPDATE STATUS + CUSTOMER INFO --}}
            <div class="lg:col-span-1 space-y-6">

                {{-- UPDATE STATUS --}}
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Update Status</h3>

                    <form action="{{ route('admin.orders.updateStatus', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">
                            Order Status
                        </label>
                        <select name="status"
                                id="status"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 mb-4">
                            @foreach (['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'] as $status)
                                <option value="{{ $status }}"
                                    {{ $order->status === $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>

                        <button type="submit"
                                class="w-full bg-green-700 hover:bg-green-800 text-white font-medium py-2.5 rounded">
                            Update Status
                        </button>
                    </form>
                </div>

                {{-- CUSTOMER INFO --}}
                <div class="bg-white rounded-lg shadow p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Customer</h3>

                    @if ($order->user)
                        <div class="space-y-2 text-sm">
                            <div>
                                <div class="text-xs text-gray-500 uppercase tracking-wide">Name</div>
                                <div class="text-gray-800 font-medium">{{ $order->user->name }}</div>
                            </div>
                            <div>
                                <div class="text-xs text-gray-500 uppercase tracking-wide">Email</div>
                                <div class="text-gray-800">{{ $order->user->email }}</div>
                            </div>
                            @if ($order->user->phone)
                                <div>
                                    <div class="text-xs text-gray-500 uppercase tracking-wide">Phone</div>
                                    <div class="text-gray-800">{{ $order->user->phone }}</div>
                                </div>
                            @endif
                        </div>
                    @else
                        <p class="text-sm text-gray-500">Guest order</p>
                    @endif
                </div>

                {{-- ORDER META --}}
                <div class="bg-gray-50 rounded-lg border border-gray-100 p-6 text-sm">
                    <h3 class="font-semibold text-gray-800 mb-3">Order Info</h3>
                    <dl class="space-y-2">
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Created</dt>
                            <dd class="text-gray-800">{{ $order->created_at->format('M d, Y') }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Last update</dt>
                            <dd class="text-gray-800">{{ $order->updated_at->diffForHumans() }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-gray-500">Items</dt>
                            <dd class="text-gray-800">{{ $order->items->sum('quantity') }}</dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection