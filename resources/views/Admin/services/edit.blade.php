@extends('layouts.admin')

@section('title', __('messages.edit_service'))

@section('content')
<div class="container px-4 py-8 mx-auto">
    <h1 class="mb-6 text-3xl font-bold">{{ __('messages.edit_service') }}</h1>
    
    <div class="p-8 bg-white rounded-lg shadow-lg">
        <form action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-6">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">{{ __('messages.title') }}</label>
                <input type="text" name="title" id="title" required
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       value="{{ old('title', $service->title) }}">
            </div>

            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700">{{ __('messages.description') }}</label>
                <textarea name="description" id="description" rows="4" required
                          class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $service->description) }}</textarea>
            </div>

            <div class="mb-6">
                <label for="image" class="block mb-2 text-sm font-medium text-gray-700">{{ __('messages.service_image') }}</label>
                
                @if($service->image)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $service->image) }}" 
                             alt="{{ __('messages.current_image') }}" 
                             class="object-cover w-32 h-32 border rounded-md">
                        <p class="mt-1 text-sm text-gray-500">{{ __('messages.current_image') }}</p>
                    </div>
                @endif
                
                <input type="file" name="image" id="image" accept="image/*"
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <p class="mt-1 text-sm text-gray-500">{{ __('messages.keep_current_image') }}</p>
            </div>

            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.services.index') }}" 
                   class="px-4 py-2 text-white bg-gray-500 rounded-md hover:bg-gray-600">
                    {{ __('messages.cancel') }}
                </a>
                <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    {{ __('messages.update_service') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection