<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('messages.edit_about_section') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('admin.about.update', $about->id ?? 1) }}" method="POST" enctype="multipart/form-data">
                        @csrf @method('PUT')
                        
                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">{{ __('messages.content') }}</label>
                            <textarea name="content" rows="6" class="w-full px-4 py-2 border rounded-lg @error('content') border-red-500 @enderror" required>{{ old('content', $about->content ?? '') }}</textarea>
                            @error('content') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 mb-2">{{ __('messages.about_image') }}</label>
                            @if($about && $about->image)
                                <img src="{{ asset('storage/' . $about->image) }}" width="200" class="rounded mb-2">
                            @endif
                            <input type="file" name="image" class="w-full px-4 py-2 border rounded-lg @error('image') border-red-500 @enderror">
                            @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg">{{ __('messages.update_about_section') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>