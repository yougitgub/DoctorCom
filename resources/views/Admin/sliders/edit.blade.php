<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('messages.edit_slider') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.sliders.update', $slider) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">{{ __('messages.title') }}</label>
                            <input type="text" name="title" value="{{ old('title', $slider->title) }}" class="w-full px-4 py-2 border rounded-lg @error('title') border-red-500 @enderror" required>
                            @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">{{ __('messages.description') }}</label>
                            <textarea name="description" rows="3" class="w-full px-4 py-2 border rounded-lg">{{ old('description', $slider->description) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">{{ __('messages.current_image') }}</label>
                            <img src="{{ asset('storage/' . $slider->image) }}" width="200" class="rounded mb-2">
                            <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg @error('image') border-red-500 @enderror">
                            @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" {{ $slider->is_active ? 'checked' : '' }} class="mr-2">
                                <span class="text-gray-700">{{ __('messages.active') }}</span>
                            </label>
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg">{{ __('messages.update_slider') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>