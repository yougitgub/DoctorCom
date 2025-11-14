<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">📸 {{ __('messages.manage_sliders') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('admin.sliders.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg mb-4 inline-block">{{ __('messages.add_new_slider') }}</a>
                    
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full mt-4 border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border">{{ __('messages.image') }}</th>
                                <th class="px-4 py-2 border">{{ __('messages.title') }}</th>
                                <th class="px-4 py-2 border">{{ __('messages.status') }}</th>
                                <th class="px-4 py-2 border">{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sliders as $slider)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2 border">
                                    <img src="{{ asset('storage/' . $slider->image) }}" width="100" class="rounded">
                                </td>
                                <td class="px-4 py-2 border">{{ $slider->title }}</td>
                                <td class="px-4 py-2 border">
                                    <span class="px-2 py-1 rounded text-xs {{ $slider->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $slider->is_active ? __('messages.active') : __('messages.inactive') }}
                                    </span>
                                </td>
                                <td class="px-4 py-2 border">
                                    <a href="{{ route('admin.sliders.edit', $slider) }}" class="text-blue-600 hover:underline">{{ __('messages.edit') }}</a>
                                    <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" class="inline ml-3" onsubmit="return confirm('{{ __('messages.delete_this_slider') }}')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">{{ __('messages.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center text-gray-500">{{ __('messages.no_sliders_found') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>