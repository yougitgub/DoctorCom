@extends('layouts.frontend')

@section('title', __('messages.services'))

@section('content')
<h1>{{ __('messages.services') }}</h1>

{{-- Instead of hardcoded text --}}
<p>{{ __('messages.no_sessions_available') }}</p>

<div class="px-4 py-8 mx-auto max-w-7xl">
    <h1 class="mb-8 text-3xl font-bold text-gray-800">
    {{ __('messages.available_sessions') }}
</h1>

    @if($sessions->isEmpty())
        <div class="p-4 border-l-4 border-blue-400 rounded bg-blue-50">
            <p class="text-blue-700">{{ __('messages.no_sessions_available') }}</p>
        </div>
    @else
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            @foreach($sessions as $session)
                <div class="p-6 transition-shadow bg-white rounded-lg shadow-md hover:shadow-lg">
                    <div class="flex items-center mb-4">
                        <div class="flex items-center justify-center w-12 h-12 bg-blue-100 rounded-full">
                            <span class="text-lg font-bold text-blue-600">
                                {{ substr($session->doctor->name ?? 'DR', 0, 2) }}
                            </span>
                        </div>
                        <div class="ml-4">
                            <h3 class="font-semibold text-gray-800">
                                {{ __('messages.dr') }} {{ $session->doctor->name ?? __('messages.unknown_doctor') }}
                            </h3>
                            <p class="text-sm text-gray-500">
                                {{ $session->doctor->specialty ?? __('messages.general_practice') }}
                            </p>
                        </div>
                    </div>

                    <div class="mb-4 space-y-2">
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            {{ $session->date_time->format('M d, Y') }}
                        </div>
                        <div class="flex items-center text-sm text-gray-600">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                                      d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $session->date_time->format('g:i A') }}
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                     bg-green-100 text-green-800">
                            {{ __('messages.available') }}
                        </span>

                        <a href="{{ route('sessions.show', $session) }}" 
                           class="px-4 py-2 text-sm font-medium text-white transition-colors bg-blue-600 rounded-md hover:bg-blue-700">
                            {{ __('messages.book_now') }}
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $sessions->links() }}
        </div>
    @endif
</div>
@endsection