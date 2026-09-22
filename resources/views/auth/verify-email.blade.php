@section('title', 'Verify Email')

<x-guest-layout>
    <h1 class="text-xl font-bold text-gray-800 mb-1">Verify Your Email</h1>
    <p class="text-sm text-gray-500 mb-6">
        Thanks for signing up! Before you can start ordering, please verify your email address by clicking the link we just sent you. If you didn't receive it, we can send another.
    </p>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-700 bg-green-50 border border-green-200 px-3 py-2 rounded">
            A new verification link has been sent to the email address you provided during registration.
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="underline text-sm text-gray-600 hover:text-green-700 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>