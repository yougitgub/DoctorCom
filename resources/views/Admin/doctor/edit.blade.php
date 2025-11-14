@extends('layouts.admin')

@section('title', __('messages.edit_doctor_information'))

@section('content')
<div class="container px-4 py-8 mx-auto">
    <h1 class="mb-6 text-3xl font-bold">{{ __('messages.edit_doctor_information') }}</h1>
    
    <div class="p-8 bg-white rounded-lg shadow-lg">
        <form action="{{ route('admin.doctor.update') }}" method="POST">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-700">{{ __('messages.doctor_name') }}</label>
                <input type="text" name="name" id="name" 
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       value="{{ old('name', $doctor->name) }}" required>
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="specialty" class="block mb-2 text-sm font-medium text-gray-700">{{ __('messages.specialty') }}</label>
                <input type="text" name="specialty" id="specialty" 
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       value="{{ old('specialty', $doctor->specialty) }}" required>
                @error('specialty') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block mb-2 text-sm font-medium text-gray-700">{{ __('messages.email') }}</label>
                <input type="email" name="email" id="email" 
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       value="{{ old('email', $doctor->email) }}" required>
                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="phone" class="block mb-2 text-sm font-medium text-gray-700">{{ __('messages.phone') }}</label>
                <input type="text" name="phone" id="phone" 
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       value="{{ old('phone', $doctor->phone) }}">
                @error('phone') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="mb-6">
                <label for="bio" class="block mb-2 text-sm font-medium text-gray-700">{{ __('messages.bio') }}</label>
                <textarea name="bio" id="bio" rows="4" 
                          class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('bio', $doctor->bio) }}</textarea>
                @error('bio') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    {{ __('messages.update_information') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection