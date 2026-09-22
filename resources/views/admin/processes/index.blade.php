@extends('layouts.admin')

@section('title', 'Production Process')

@section('content')
    <div class="space-y-4">

        {{-- HEADER --}}
        <div class="flex items-center justify-between">
            <p class="text-sm text-gray-600">
                Manage the steps that explain how GVC egusi goes from farm to kitchen.
            </p>
            <a href="{{ route('admin.processes.create') }}"
               class="bg-green-700 hover:bg-green-800 text-white text-sm px-4 py-2 rounded">
                + Add New Stage
            </a>
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if ($processes->isEmpty())
                <div class="p-8 text-center text-gray-500">
                    No production stages yet. Click "Add New Stage" to create your first one.
                    <p class="text-xs text-gray-400 mt-2">
                        Suggested stages: Planting &amp; Farming, Harvesting, Processing, Packaging.
                    </p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="text-left px-5 py-3 w-16">Order</th>
                                <th class="text-left px-5 py-3">Image</th>
                                <th class="text-left px-5 py-3">Title</th>
                                <th class="text-left px-5 py-3">Slug</th>
                                <th class="text-left px-5 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($processes as $process)
                                <tr class="border-t border-gray-100 hover:bg-gray-50">
                                    {{-- STAGE ORDER --}}
                                    <td class="px-5 py-3">
                                        <span class="inline-flex w-8 h-8 rounded-full bg-green-100 text-green-800 text-xs font-bold items-center justify-center">
                                            {{ $process->stage_order }}
                                        </span>
                                    </td>

                                    {{-- IMAGE --}}
                                    <td class="px-5 py-3">
                                        @if ($process->image)
                                            <img src="{{ asset('images/processes/' . $process->image) }}"
                                                 alt="{{ $process->title }}"
                                                 class="w-14 h-14 object-cover rounded border border-gray-200">
                                        @else
                                            <div class="w-14 h-14 bg-gray-100 rounded border border-gray-200 flex items-center justify-center text-[10px] text-gray-400">
                                                No Image
                                            </div>
                                        @endif
                                    </td>

                                    {{-- TITLE + DESCRIPTION --}}
                                    <td class="px-5 py-3">
                                        <div class="font-medium text-gray-800">{{ $process->title }}</div>
                                        <div class="text-xs text-gray-500 mt-0.5">
                                            {{ \Illuminate\Support\Str::limit($process->description, 60) }}
                                        </div>
                                    </td>

                                    {{-- SLUG --}}
                                    <td class="px-5 py-3 text-gray-500 font-mono text-xs">
                                        {{ $process->slug }}
                                    </td>

                                    {{-- ACTIONS --}}
                                    <td class="px-5 py-3">
                                        <div class="flex items-center gap-2">
                                            <a href="{{ route('admin.processes.edit', $process) }}"
                                               class="text-blue-600 hover:underline text-xs font-medium">
                                                Edit
                                            </a>

                                            <form action="{{ route('admin.processes.destroy', $process) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Delete this stage? This cannot be undone.');">
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
            @endif
        </div>
    </div>
@endsection