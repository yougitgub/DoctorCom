@extends('layouts.admin')

@section('title', __('messages.appointments') . ' - ' . __('messages.admin_dashboard'))

@section('content')
<div class="container px-4 py-4 sm:py-8 mx-auto">
    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4 sm:mb-6 gap-3">
        <h1 class="text-2xl sm:text-3xl font-bold text-gray-800">{{ __('messages.appointments') }}</h1>
        @if($pendingCount > 0)
            <span class="px-3 py-1 text-xs sm:text-sm font-medium text-yellow-800 bg-yellow-100 rounded-full">
                {{ $pendingCount }} {{ __('messages.pending') }}
            </span>
        @endif
    </div>

    <div class="overflow-hidden bg-white rounded-lg shadow">
        <div class="overflow-x-auto -mx-4 sm:mx-0">
            <div class="inline-block min-w-full align-middle">
                <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-3 sm:px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">{{ __('messages.id') }}</th>
                        <th class="px-3 sm:px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">{{ __('messages.patient') }}</th>
                        <th class="px-3 sm:px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase hidden md:table-cell">{{ __('messages.doctor') }}</th>
                        <th class="px-3 sm:px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">{{ __('messages.date_time') }}</th>
                        <th class="px-3 sm:px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase hidden lg:table-cell">{{ __('messages.session') }}</th>
                        <th class="px-3 sm:px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">{{ __('messages.status') }}</th>
                        <th class="px-3 sm:px-6 py-3 text-xs font-medium tracking-wider text-left text-gray-500 uppercase">{{ __('messages.actions') }}</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($appointments as $appointment)
                        <tr class="hover:bg-gray-50">
                            <td class="px-3 sm:px-6 py-4 text-xs sm:text-sm font-medium text-gray-900 whitespace-nowrap">
                                #{{ $appointment->id }}
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap">
                                <div class="text-xs sm:text-sm font-medium text-gray-900">
                                    {{ $appointment->patient_name }}
                                </div>
                                <div class="text-xs sm:text-sm text-gray-500">
                                    {{ $appointment->patient_email }}
                                </div>
                            </td>
                            <td class="px-3 sm:px-6 py-4 whitespace-nowrap hidden md:table-cell">
                                <div class="text-xs sm:text-sm text-gray-900">
                                    {{ __('messages.dr') }} {{ $appointment->doctor?->name ?? __('messages.na') }}
                                </div>
                            </td>
                            <td class="px-3 sm:px-6 py-4 text-xs sm:text-sm text-gray-500 whitespace-nowrap">
                                {{ $appointment->appointment_date?->format('M d, Y g:i A') ?? __('messages.na') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $appointment->session?->status === 'available' ? 'bg-green-100 text-green-800' : 
                                       ($appointment->session?->status === 'booked' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') }}">
                                    @if($appointment->session?->status === 'available')
                                        {{ __('messages.available') }}
                                    @elseif($appointment->session?->status === 'booked')
                                        {{ __('messages.booked') }}
                                    @else
                                        {{ __('messages.na') }}
                                    @endif
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
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
                            </td>
                            <td class="px-3 sm:px-6 py-4 text-xs sm:text-sm font-medium">
                                <div class="flex flex-col sm:flex-row gap-1 sm:gap-2">
                                    <a href="{{ route('admin.appointments.show', $appointment) }}" 
                                       class="text-blue-600 hover:text-blue-900 transition whitespace-nowrap">{{ __('messages.view') }}</a>
                                    
                                    @if($appointment->isPending())
                                        <form action="{{ route('admin.appointments.approve', $appointment) }}" 
                                              method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-green-600 hover:text-green-900 transition whitespace-nowrap">{{ __('messages.approve') }}</button>
                                        </form>
                                        <form action="{{ route('admin.appointments.reject', $appointment) }}" 
                                              method="POST" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-red-600 hover:text-red-900 transition whitespace-nowrap">{{ __('messages.reject') }}</button>
                                        </form>
                                    @elseif($appointment->isRejected())
                                        <span class="text-gray-400 whitespace-nowrap">{{ __('messages.rejected') }}</span>
                                    @else
                                        <span class="text-green-600 whitespace-nowrap">{{ __('messages.approved_checkmark') }}</span>
                                    @endif
                                    
                                    <form action="{{ route('admin.appointments.destroy', $appointment) }}" 
                                          method="POST" class="inline" 
                                          onsubmit="return confirm('{{ __('messages.are_you_sure') }}');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 transition whitespace-nowrap">{{ __('messages.delete') }}</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-4 text-center text-gray-500">
                                {{ __('messages.no_appointments_found') }}
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4">
            {{ $appointments->links() }}
        </div>
    </div>
</div>
@endsection