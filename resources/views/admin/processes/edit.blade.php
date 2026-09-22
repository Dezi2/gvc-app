@extends('layouts.admin')

@section('title', 'Edit Production Stage')

@section('content')
    <div class="max-w-3xl">

        {{-- BACK LINK --}}
        <div class="mb-4">
            <a href="{{ route('admin.processes.index') }}"
               class="text-sm text-green-700 hover:underline">
                &larr; Back to Production Process
            </a>
        </div>

        {{-- FORM CARD --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-1">
                Edit Stage: {{ $process->title }}
            </h3>
            <p class="text-sm text-gray-500 mb-5">
                Update the details of this production stage.
            </p>

            <form action="{{ route('admin.processes.update', $process) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                    {{-- TITLE --}}
                    <div class="md:col-span-2">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-1">
                            Stage Title <span class="text-red-600">*</span>
                        </label>
                        <input type="text"
                               name="title"
                               id="title"
                               value="{{ old('title', $process->title) }}"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- STAGE ORDER --}}
                    <div>
                        <label for="stage_order" class="block text-sm font-medium text-gray-700 mb-1">
                            Stage Number <span class="text-red-600">*</span>
                        </label>
                        <input type="number"
                               name="stage_order"
                               id="stage_order"
                               value="{{ old('stage_order', $process->stage_order) }}"
                               min="1"
                               class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('stage_order') border-red-500 @enderror">
                        <p class="text-xs text-gray-500 mt-1">
                            Lower numbers show first. Example: 1 = Planting, 2 = Harvesting.
                        </p>
                        @error('stage_order')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- CURRENT IMAGE + NEW UPLOAD --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">
                            Stage Image
                        </label>

                        @if ($process->image)
                            <div class="flex items-center gap-3 mb-2">
                                <img src="{{ asset('images/processes/' . $process->image) }}"
                                     alt="{{ $process->title }}"
                                     class="w-16 h-16 object-cover rounded border border-gray-200">
                                <span class="text-xs text-gray-500">Current image</span>
                            </div>
                        @else
                            <p class="text-xs text-gray-500 mb-2">No image uploaded yet.</p>
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

                    {{-- DESCRIPTION --}}
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                            Description <span class="text-red-600">*</span>
                        </label>
                        <textarea name="description"
                                  id="description"
                                  rows="5"
                                  class="w-full border-gray-300 rounded-md shadow-sm focus:border-green-500 focus:ring focus:ring-green-200 @error('description') border-red-500 @enderror">{{ old('description', $process->description) }}</textarea>
                        @error('description')
                            <p class="text-red-600 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- ACTIONS --}}
                <div class="flex items-center gap-3 pt-5 mt-2 border-t border-gray-100">
                    <button type="submit"
                            class="bg-green-700 hover:bg-green-800 text-white font-medium px-5 py-2 rounded">
                        Update Stage
                    </button>
                    <a href="{{ route('admin.processes.index') }}"
                       class="text-gray-600 hover:text-gray-800 text-sm">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection