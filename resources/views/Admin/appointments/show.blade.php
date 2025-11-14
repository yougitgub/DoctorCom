@extends('layouts.admin')

@section('title', __('messages.appointment_details_title') . ' #' . $appointment->id)

@section('content')
<div class="container px-4 py-8 mx-auto">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-800">
            {{ __('messages.appointment_number') }}{{ $appointment->id }}
        </h1>
        <div class="flex space-x-3">
            <a href="{{ route('admin.appointments.index') }}" 
               class="px-4 py-2 text-white bg-gray-500 rounded hover:bg-gray-600">
                {{ __('messages.back_to_list') }}
            </a>
            <form action="{{ route('admin.appointments.destroy', $appointment) }}" 
                  method="POST" class="inline" 
                  onsubmit="return confirm('{{ __('messages.delete_appointment_confirm') }}');">
                @csrf
                @method('DELETE')
                <button type="submit" class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                    {{ __('messages.delete_appointment') }}
                </button>
            </form>
        </div>
    </div>

    <div class="p-8 bg-white rounded-lg shadow-lg">
        <!-- Patient Information -->
        <div class="mb-8">
            <h2 class="mb-4 text-xl font-semibold text-gray-800">{{ __('messages.patient_information') }}</h2>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-600">{{ __('messages.name') }}</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $appointment->patient_name }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">{{ __('messages.email') }}</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $appointment->patient_email }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">{{ __('messages.phone') }}</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $appointment->patient_phone }}</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">{{ __('messages.booking_user') }}</label>
                    <p class="mt-1 text-lg text-gray-900">{{ $appointment->user->name ?? __('messages.na') }}</p>
                </div>
            </div>
        </div>

        <!-- Appointment Details -->
        <div class="mb-8">
            <h2 class="mb-4 text-xl font-semibold text-gray-800">{{ __('messages.appointment_details') }}</h2>
            <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                <div>
                    <label class="block text-sm font-medium text-gray-600">{{ __('messages.appointment_date') }}</label>
                    <p class="mt-1 text-lg text-gray-900">
                        {{ $appointment->appointment_date?->format('F d, Y g:i A') ?? __('messages.na') }}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">{{ __('messages.status') }}</label>
                    <span class="mt-1 inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        @if($appointment->status === 'pending') bg-yellow-100 text-yellow-800
                        @elseif($appointment->status === 'approved') bg-green-100 text-green-800
                        @elseif($appointment->status === 'rejected') bg-red-100 text-red-800
                        @else bg-gray-100 text-gray-800 @endif">
                        @if($appointment->status === 'pending')
                            {{ __('messages.pending') }}
                        @elseif($appointment->status === 'approved')
                            {{ __('messages.approved') }}
                        @elseif($appointment->status === 'rejected')
                            {{ __('messages.rejected') }}
                        @else
                            {{ ucfirst($appointment->status) }}
                        @endif
                    </span>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">{{ __('messages.doctor') }}</label>
                    <p class="mt-1 text-lg text-gray-900">
                        {{ __('messages.dr') }} {{ $appointment->session?->doctor?->name ?? __('messages.unknown') }}
                    </p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-600">{{ __('messages.session_id') }}</label>
                    <p class="mt-1 text-lg text-gray-900">#{{ $appointment->session_id }}</p>
                </div>
            </div>
        </div>

        <!-- Notes -->
        @if($appointment->notes)
            <div class="mb-8">
                <h2 class="mb-4 text-xl font-semibold text-gray-800">{{ __('messages.notes') }}</h2>
                <div class="p-4 rounded-lg bg-gray-50">
                    <p class="text-gray-700">{{ $appointment->notes }}</p>
                </div>
            </div>
        @endif

        <!-- Actions -->
        <div class="flex justify-end pt-6 space-x-3 border-t border-gray-200">
            @if($appointment->status === 'pending')
                <form action="{{ route('admin.appointments.approve', $appointment) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-6 py-2 text-white bg-green-600 rounded hover:bg-green-700">
                        {{ __('messages.approve') }}
                    </button>
                </form>
                <form action="{{ route('admin.appointments.reject', $appointment) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="px-6 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                        {{ __('messages.reject') }}
                    </button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection