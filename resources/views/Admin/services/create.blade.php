@extends('layouts.admin')

@section('title', __('messages.create') . ' ' . __('messages.services'))

@section('content')
<div class="container px-4 py-8 mx-auto">
    <h1 class="mb-6 text-3xl font-bold">{{ __('messages.create') }} {{ __('messages.services') }}</h1>
    
    <div class="p-8 bg-white rounded-lg shadow-lg">
        <form action="{{ route('admin.services.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-6">
                <label for="title" class="block mb-2 text-sm font-medium text-gray-700">{{ __('messages.title') }}</label>
                <input type="text" name="title" id="title" required
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       value="{{ old('title') }}">
            </div>

            <div class="mb-6">
                <label for="description" class="block mb-2 text-sm font-medium text-gray-700">{{ __('messages.description') }}</label>
                <textarea name="description" id="description" rows="4" required
                          class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>

            <div class="mb-6">
                <label for="image" class="block mb-2 text-sm font-medium text-gray-700">{{ __('messages.service_image') }}</label>
                <input type="file" name="image" id="image" accept="image/*" required
                       class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                <p class="mt-1 text-sm text-gray-500">{{ __('messages.upload_image_hint') }}</p>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="px-6 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                    {{ __('messages.create') }} {{ __('messages.services') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection