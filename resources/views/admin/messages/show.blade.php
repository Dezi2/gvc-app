@extends('layouts.admin')

@section('title', 'Message from ' . $message->name)

@section('content')
    <div class="max-w-4xl space-y-6">

        {{-- BACK LINK --}}
        <a href="{{ route('admin.messages.index') }}"
           class="text-sm text-green-700 hover:underline">
            &larr; Back to Messages
        </a>

        {{-- HEADER --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">

                <div class="min-w-0">
                    <div class="flex items-center gap-2 mb-1">
                        @if (!$message->is_read)
                            <span class="inline-block w-2.5 h-2.5 rounded-full bg-green-600"></span>
                            <span class="text-xs font-semibold text-green-700 uppercase tracking-wide">Unread</span>
                        @else
                            <span class="inline-block w-2.5 h-2.5 rounded-full bg-gray-300"></span>
                            <span class="text-xs font-medium text-gray-500 uppercase tracking-wide">Read</span>
                        @endif
                    </div>

                    <h2 class="text-xl font-bold text-gray-800 break-words">
                        {{ $message->subject }}
                    </h2>

                    <p class="text-sm text-gray-500 mt-2">
                        From
                        <strong class="text-gray-800">{{ $message->name }}</strong>
                        &lt;{{ $message->email }}&gt;
                    </p>

                    <p class="text-xs text-gray-500 mt-1">
                        Received {{ $message->created_at->format('M d, Y \a\t h:i A') }}
                        ({{ $message->created_at->diffForHumans() }})
                    </p>
                </div>

                {{-- QUICK ACTIONS --}}
                <div class="flex items-center gap-2 flex-shrink-0">
                    <form action="{{ route('admin.messages.toggleRead', $message) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit"
                                class="text-xs bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium px-3 py-2 rounded">
                            Mark as {{ $message->is_read ? 'unread' : 'read' }}
                        </button>
                    </form>

                    <form action="{{ route('admin.messages.destroy', $message) }}"
                          method="POST"
                          onsubmit="return confirm('Delete this message? This cannot be undone.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="text-xs bg-red-600 hover:bg-red-700 text-white font-medium px-3 py-2 rounded">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- MESSAGE BODY --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6 md:p-8">
            <h3 class="text-sm font-semibold text-gray-500 uppercase tracking-wide mb-4">Message</h3>

            <div class="text-gray-800 leading-relaxed whitespace-pre-line">
                {{ $message->message }}
            </div>
        </div>

        {{-- REPLY ACTIONS --}}
        <div class="bg-gray-50 rounded-lg border border-gray-100 p-6">
            <h3 class="font-semibold text-gray-800 mb-2">Reply to this customer</h3>
            <p class="text-sm text-gray-600 mb-4">
                You can reply directly from your own email client.
            </p>

            <div class="flex flex-wrap items-center gap-3">
                <a href="mailto:{{ $message->email }}?subject={{ rawurlencode('Re: ' . $message->subject) }}"
                   class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white text-sm font-medium px-4 py-2 rounded transition">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6" />
                    </svg>
                    Reply via Email
                </a>

                <button type="button"
                        onclick="navigator.clipboard.writeText('{{ $message->email }}'); this.textContent = 'Copied!'; setTimeout(() => this.textContent = 'Copy Email', 2000);"
                        class="text-sm text-gray-700 hover:text-gray-900 bg-white border border-gray-300 px-4 py-2 rounded">
                    Copy Email
                </button>
            </div>
        </div>

        {{-- SENDER INFO --}}
        <div class="bg-white rounded-lg shadow-sm border border-gray-100 p-6">
            <h3 class="font-semibold text-gray-800 mb-4">Sender Information</h3>

            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wide mb-1">Name</dt>
                    <dd class="text-gray-800 font-medium">{{ $message->name }}</dd>
                </div>
                <div>
                    <dt class="text-gray-500 text-xs uppercase tracking-wide mb-1">Email</dt>
                    <dd class="text-gray-800 font-medium break-all">{{ $message->email }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-gray-500 text-xs uppercase tracking-wide mb-1">Subject</dt>
                    <dd class="text-gray-800 font-medium">{{ $message->subject }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-gray-500 text-xs uppercase tracking-wide mb-1">Received</dt>
                    <dd class="text-gray-800 font-medium">
                        {{ $message->created_at->format('l, F j, Y \a\t g:i A') }}
                    </dd>
                </div>
            </dl>
        </div>

    </div>
@endsection
