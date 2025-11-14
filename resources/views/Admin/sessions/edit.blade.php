@extends('layouts.admin')

@section('title', __('messages.edit_session'))

@section('content')
<div class="container px-4 py-8 mx-auto">
    <h1 class="mb-6 text-3xl font-bold">{{ __('messages.edit_session') }}</h1>
    
    <div class="p-8 bg-white rounded-lg shadow-lg">
        <form action="{{ route('admin.sessions.update', $session) }}" method="POST">
            @csrf
            @method('PUT')
            
            {{-- Doctor info displayed (read-only) --}}
            <div class="mb-6">
                <label class="block mb-2 text-sm font-medium text-gray-700">{{ __('messages.doctor') }}</label>
                <div class="p-3 bg-gray-100 rounded-md">
                    {{ __('messages.dr') }} {{ App\Models\Doctor::find(1)->name ?? __('messages.default_doctor') }}
                </div>
            </div>

            <div class="mb-6">
                <label for="date_time" class="block mb-2 text-sm font-medium text-gray-700">{{ __('messages.date_time') }}</label>
                <input type="datetime-local" name="date_time" id="date_time" 
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       value="{{ old('date_time', $session->date_time->format('Y-m-d\TH:i')) }}" required>
                @error('date_time') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="status" class="block mb-2 text-sm font-medium text-gray-700">{{ __('messages.status') }}</label>
                <select name="status" id="status" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                    <option value="available" {{ old('status', $session->status) == 'available' ? 'selected' : '' }}>{{ __('messages.available') }}</option>
                    <option value="booked" {{ old('status', $session->status) == 'booked' ? 'selected' : '' }}>{{ __('messages.booked') }}</option>
                    <option value="pending" {{ old('status', $session->status) == 'pending' ? 'selected' : '' }}>{{ __('messages.pending') }}</option>
                </select>
                @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    {{ __('messages.update_session') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection