@extends('layouts.frontend')

@section('content')
<div class="py-16">
    <div class="max-w-7xl mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">{{ __('messages.available_sessions') }}</h2>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(!auth()->check())
            <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-6">
                {{ __('messages.please_login_to_book') }} <a href="{{ route('login') }}" class="underline font-semibold">{{ __('messages.login') }}</a> {{ __('messages.to_book_a_session') }}
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($sessions as $session)
            <div class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition">
                <div class="mb-4">
                    <h3 class="text-xl font-semibold">{{ $session->doctor->name }}</h3>
                    <p class="text-gray-600">{{ $session->doctor->specialty }}</p>
                </div>
                <div class="mb-4 space-y-2">
                    <p class="text-gray-700">{{ $session->date_time->format('M d, Y') }}</p>
                    <p class="text-gray-700">{{ $session->date_time->format('h:i A') }}</p>
                </div>
                <div class="mb-4">
                    <p class="text-sm text-gray-600">{{ Str::limit($session->doctor->bio, 100) }}</p>
                </div>
                @auth
                    <form action="{{ route('booking.book', $session) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700 disabled:bg-gray-400" 
                                @if(!$session->isAvailable()) disabled @endif>
                            {{ __('messages.book_this_session') }}
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="block w-full text-center bg-gray-400 text-white py-2 rounded-lg">{{ __('messages.login_to_book') }}</a>
                @endauth
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <p class="text-gray-600 text-lg">{{ __('messages.no_sessions_available') }}</p>
                <p class="text-gray-500 mt-2">{{ __('messages.check_back_later') }}</p>
            </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $sessions->links() }}
        </div>
    </div>
</div>
@endsection