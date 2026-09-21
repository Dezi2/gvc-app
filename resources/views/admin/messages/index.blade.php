@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')
    <div class="space-y-4">

        {{-- HEADER --}}
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div>
                <p class="text-sm text-gray-600">
                    Messages sent from the public contact form.
                </p>
                @if ($unreadCount > 0)
                    <p class="text-sm text-green-700 font-medium mt-1">
                        You have {{ $unreadCount }} unread
                        {{ \Illuminate\Support\Str::plural('message', $unreadCount) }}.
                    </p>
                @endif
            </div>
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if ($messages->isEmpty())
                <div class="p-8 text-center text-gray-500">
                    <div class="w-16 h-16 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-800 mb-1">No messages yet</h3>
                    <p class="text-sm text-gray-500">
                        Messages from the public contact form will appear here.
                    </p>
                </div>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs">
                            <tr>
                                <th class="text-left px-5 py-3 w-10"></th>
                                <th class="text-left px-5 py-3">From</th>
                                <th class="text-left px-5 py-3">Subject</th>
                                <th class="text-left px-5 py-3">Date</th>
                                <th class="text-left px-5 py-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($messages as $message)
                                <tr class="border-t border-gray-100 hover:bg-gray-50 {{ !$message->is_read ? 'bg-green-50/40' : '' }}">
                                    {{-- UNREAD DOT --}}
                                    <td class="px-5 py-3">
                                        @if (!$message->is_read)
                                            <span class="inline-block w-2.5 h-2.5 rounded-full bg-green-600"
                                                  title="Unread"></span>
                                        @else
                                            <span class="inline-block w-2.5 h-2.5 rounded-full bg-gray-200"
                                                  title="Read"></span>
                                        @endif
                                    </td>

                                    {{-- FROM --}}
                                    <td class="px-5 py-3">
                                        <div class="font-medium text-gray-800 {{ !$message->is_read ? 'font-bold' : '' }}">
                                            {{ $message->name }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $message->email }}
                                        </div>
                                    </td>

                                    {{-- SUBJECT --}}
                                    <td class="px-5 py-3">
                                        <div class="text-gray-800 {{ !$message->is_read ? 'font-semibold' : '' }}">
                                            {{ $message->subject }}
                                        </div>
                                        <div class="text-xs text-gray-500 mt-0.5">
                                            {{ \Illuminate\Support\Str::limit($message->message, 60) }}
                                        </div>
                                    </td>

                                    {{-- DATE --}}
                                    <td class="px-5 py-3 text-gray-500 text-xs whitespace-nowrap">
                                        {{ $message->created_at->format('M d, Y') }}<br>
                                        <span class="text-gray-400">{{ $message->created_at->format('h:i A') }}</span>
                                    </td>

                                    {{-- ACTIONS --}}
                                    <td class="px-5 py-3">
                                        <div class="flex items-center gap-3">
                                            <a href="{{ route('admin.messages.show', $message) }}"
                                               class="text-blue-600 hover:underline text-xs font-medium">
                                                View
                                            </a>

                                            <form action="{{ route('admin.messages.toggleRead', $message) }}"
                                                  method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit"
                                                        class="text-gray-600 hover:underline text-xs font-medium">
                                                    Mark {{ $message->is_read ? 'unread' : 'read' }}
                                                </button>
                                            </form>

                                            <form action="{{ route('admin.messages.destroy', $message) }}"
                                                  method="POST"
                                                  onsubmit="return confirm('Delete this message? This cannot be undone.');">
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
                    {{ $messages->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection