@extends('layouts.frontend')

@section('content')
<div class="py-16">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white p-8 rounded-lg shadow-md text-center">
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    {{ session('success') }}
                </div>
            @endif

            <h2 class="text-2xl font-bold mb-4">{{ __('messages.session_booked_successfully') }}</h2>
            <p class="text-gray-600 mb-6">{{ __('messages.appointment_pending_approval') }}</p>

            <div class="bg-gray-50 p-4 rounded-lg mb-6 text-left">
                <h3 class="font-semibold mb-2">{{ __('messages.appointment_details') }}:</h3>
                <p><strong>{{ __('messages.date_time') }}:</strong> {{ $appointment->session->date_time->format('M d, Y h:i A') }}</p>
                <p><strong>{{ __('messages.doctor') }}:</strong> {{ $appointment->session->doctor->name }}</p>
                <p><strong>{{ __('messages.specialty') }}:</strong> {{ $appointment->session->doctor->specialty }}</p>
                <p><strong>{{ __('messages.status') }}:</strong> <span class="text-yellow-600">{{ __('messages.pending_approval') }}</span></p>
            </div>

            <a href="{{ route('home') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                {{ __('messages.back_to_home') }}
            </a>
        </div>
    </div>
</div>
@endsection