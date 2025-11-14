<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('messages.about_section') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <a href="{{ route('admin.about.edit', $about) }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg inline-block">{{ __('messages.edit_about_section') }}</a>
                    
                    <div class="mt-6">
                        @if($about->image)
                            <img src="{{ asset('storage/' . $about->image) }}" class="rounded-lg shadow-md mb-4 max-w-md">
                        @endif
                        <div class="prose max-w-none">
                            {!! $about->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>