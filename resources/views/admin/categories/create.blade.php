@extends('layouts.admin')

@section('title', 'Add New Category')

@section('content')
    <div class="max-w-2xl">

        {{-- BREADCRUMB / BACK --}}
        <div class="mb-4">
            <a href="{{ route('admin.categories.index') }}"
               class="text-sm text-green-700 hover:underline">
                &larr; Back to Categories
            </a>
        </div>

        {{-- FORM CARD --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Add a New Category</h3>

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                {{-- Name --}}
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        Category Name <span class="text-red-600">*</span>
                    </label>
                    <input type="text"
                           name="name"
                           id="name"
                           value="{{ old('name') }}"
                           class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('name') border-red-500 @enderror"
                           placeholder="e.g. Ground Egusi">
                    @error('name')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                        Description
                    </label>
                    <textarea name="description"
                              id="description"
                              rows="4"
                              class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('description') border-red-500 @enderror"
                              placeholder="Short description of this category (optional)">{{ old('description') }}</textarea>
                    @error('description')
                        <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ACTIONS --}}
                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                            class="bg-green-700 hover:bg-green-800 text-white font-medium px-5 py-2 rounded">
                        Save Category
                    </button>
                    <a href="{{ route('admin.categories.index') }}"
                       class="text-gray-600 hover:text-gray-800 text-sm">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection