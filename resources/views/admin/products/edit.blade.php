@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <div class="max-w-3xl">

        {{-- BACK --}}
        <div class="mb-4">
            <a href="{{ route('admin.products.index') }}"
               class="text-sm text-green-700 hover:underline">
                &larr; Back to Products
            </a>
        </div>

        {{-- FORM CARD --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                Edit Product: {{ $product->name }}
            </h3>

            {{-- IMPORTANT: enctype is required for file uploads --}}
            <form action="{{ route('admin.products.update', $product) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- NAME --}}
                    <div class="md:col-span-2">
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                            Product Name <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old('name', $product->name) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- CATEGORY --}}
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">
                            Category <span class="text-red-600">*</span>
                        </label>
                        <select name="category_id"
                                id="category_id"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('category_id') border-red-500 @enderror">
                            <option value="">— Select a Category —</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- STATUS --}}
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">
                            Status <span class="text-red-600">*</span>
                        </label>
                        <select name="status"
                                id="status"
                                class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('status') border-red-500 @enderror">
                            <option value="active"   {{ old('status', $product->status) === 'active'   ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status', $product->status) === 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- PRICE --}}
                    <div>
                        <label for="price" class="block text-sm font-medium text-gray-700 mb-1">
                            Price (₦) <span class="text-red-600">*</span>
                        </label>
                        <input type="number"
                               step="0.01"
                               min="0"
                               name="price"
                               id="price"
                               value="{{ old('price', $product->price) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('price') border-red-500 @enderror">
                        @error('price')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- STOCK --}}
                    <div>
                        <label for="stock_quantity" class="block text-sm font-medium text-gray-700 mb-1">
                            Stock Quantity <span class="text-red-600">*</span>
                        </label>
                        <input type="number"
                               min="0"
                               name="stock_quantity"
                               id="stock_quantity"
                               value="{{ old('stock_quantity', $product->stock_quantity) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('stock_quantity') border-red-500 @enderror">
                        @error('stock_quantity')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- DESCRIPTION --}}
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Description <span class="text-red-600">*</span>
                        </label>
                        <textarea name="description"
                                  id="description"
                                  rows="4"
                                  class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('description') border-red-500 @enderror">{{ old('description', $product->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- CURRENT IMAGE + UPLOAD NEW --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Product Image
                        </label>

                        @if ($product->image)
                            <div class="flex items-center gap-4 mb-3">
                                <img src="{{ asset('images/products/' . $product->image) }}"
                                     alt="{{ $product->name }}"
                                     class="w-24 h-24 object-cover rounded border border-gray-200">
                                <div class="text-xs text-gray-500">
                                    Current image<br>
                                    <span class="font-mono">{{ $product->image }}</span>
                                </div>
                            </div>
                        @else
                            <p class="text-xs text-gray-500 mb-3">No image uploaded yet.</p>
                        @endif

                        <input type="file"
                               name="image"
                               id="image"
                               accept="image/*"
                               class="w-full text-sm text-gray-700 border border-gray-300 rounded-md p-2 @error('image') border-red-500 @enderror">
                        <p class="text-xs text-gray-500 mt-1">
                            Leave empty to keep the current image. JPG, PNG, or WEBP. Max 2 MB.
                        </p>
                        @error('image')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="flex items-center gap-3 pt-5 mt-2 border-t border-gray-100">
                    <button type="submit"
                            class="bg-green-700 hover:bg-green-800 text-white font-medium px-5 py-2 rounded">
                        Update Product
                    </button>
                    <a href="{{ route('admin.products.index') }}"
                       class="text-gray-600 hover:text-gray-800 text-sm">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection