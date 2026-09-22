@extends('layouts.admin')

@section('title', 'Products')

@section('content')
    <div class="space-y-4">

        {{-- HEADER --}}
        <div class="flex items-center justify-between">
            <p class="text-sm text-gray-600">
                Manage all egusi products in your store.
            </p>
            <a href="{{ route('admin.products.create') }}"
               class="bg-green-700 hover:bg-green-800 text-white text-sm px-4 py-2 rounded">
                + Add New Product
            </a>
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if ($products->isEmpty())
                <div class="p-8 text-center text-gray-500">
                    No products yet. Click "Add New Product" to create your first one.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="text-left px-5 py-3">Image</th>
                                <th class="text-left px-5 py-3">Name</th>
                                <th class="text-left px-5 py-3">Category</th>
                                <th class="text-left px-5 py-3">Price</th>
                                <th class="text-left px-5 py-3">Stock</th>
                                <th class="text-left px-5 py-3">Status</th>
                                <th class="text-left px-5 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="border-t border-gray-100 hover:bg-gray-50">
                                    {{-- IMAGE --}}
                                    <td class="px-5 py-3">
                                        @if ($product->image)
                                            <img src="{{ asset('images/products/' . $product->image) }}"
                                                 alt="{{ $product->name }}"
                                                 class="w-14 h-14 object-cover rounded border border-gray-200">
                                        @else
                                            <div class="w-14 h-14 bg-gray-100 rounded border border-gray-200 flex items-center justify-center text-[10px] text-gray-400">
                                                No Image
                                            </div>
                                        @endif
                                    </td>

                                    {{-- NAME --}}
                                    <td class="px-5 py-3">
                                        <div class="font-medium text-gray-800">{{ $product->name }}</div>
                                        <div class="text-xs text-gray-400 font-mono">{{ $product->slug }}</div>
                                    </td>

                                    {{-- CATEGORY --}}
                                    <td class="px-5 py-3 text-gray-600">
                                        {{ $product->category->name ?? '—' }}
                                    </td>

                                    {{-- PRICE --}}
                                    <td class="px-5 py-3 font-medium text-gray-800">
                                        ₦{{ number_format($product->price, 2) }}
                                    </td>

                                    {{-- STOCK --}}
                                    <td class="px-5 py-3">
                                        @if ($product->stock_quantity <= 0)
                                            <span class="px-2 py-1 rounded text-xs bg-red-100 text-red-700">
                                                Out of stock
                                            </span>
                                        @elseif ($product->stock_quantity < 10)
                                            <span class="px-2 py-1 rounded text-xs bg-yellow-100 text-yellow-800">
                                                Low: {{ $product->stock_quantity }}
                                            </span>
                                        @else
                                            <span class="px-2 py-1 rounded text-xs bg-green-100 text-green-800">
                                                {{ $product->stock_quantity }}
                                            </span>
                                        @endif
                                    </td>

                                    {{-- STATUS --}}
                                    <td class="px-5 py-3">
                                        @if ($product->status === 'active')
                                            <span class="px-2 py-1 rounded text-xs bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        @else
                                            <span class="px-2 py-1 rounded text-xs bg-gray-200 text-gray-700">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    {{-- ACTIONS --}}
                                    <td class="px-5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.products.edit', $product) }}"
                                               class="text-blue-600 hover:underline text-xs font-medium">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.products.destroy', $product) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Delete this product? This cannot be undone.');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 hover:underline text-xs font-medium">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="px-5 py-4 border-t border-gray-200">
                    {{ $products->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection