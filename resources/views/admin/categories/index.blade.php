@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
    <div class="space-y-4">

        {{-- HEADER --}}
        <div class="flex items-center justify-between">
            <p class="text-sm text-gray-600">Manage the product categories for your store.</p>
            <a href="{{ route('admin.categories.create') }}"
               class="bg-green-700 hover:bg-green-800 text-white text-sm px-4 py-2 rounded">
                + Add New Category
            </a>
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if ($categories->isEmpty())
                <div class="p-8 text-center text-gray-500">
                    No categories yet. Click "Add New Category" to create your first one.
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="text-left px-5 py-3">#</th>
                                <th class="text-left px-5 py-3">Name</th>
                                <th class="text-left px-5 py-3">Slug</th>
                                <th class="text-left px-5 py-3">Products</th>
                                <th class="text-left px-5 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr class="border-t border-gray-100 hover:bg-gray-50">
                                    <td class="px-5 py-3 text-gray-500">
                                        {{ $categories->firstItem() + $loop->index }}
                                    </td>
                                    <td class="px-5 py-3 font-medium text-gray-800">
                                        {{ $category->name }}
                                    </td>
                                    <td class="px-5 py-3 text-gray-500 font-mono text-xs">
                                        {{ $category->slug }}
                                    </td>
                                    <td class="px-5 py-3">
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs">
                                            {{ $category->products_count }}
                                        </span>
                                    </td>
                                    <td class="px-5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.categories.edit', $category) }}"
                                               class="text-blue-600 hover:underline text-xs font-medium">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.categories.destroy', $category) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Delete this category? All products in it will also be deleted.');">
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

                {{-- PAGINATION LINKS --}}
                <div class="px-5 py-4 border-t border-gray-200">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection