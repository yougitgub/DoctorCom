<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">🎯 {{ __('messages.manage_services') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('admin.services.create') }}" class="inline-block px-4 py-2 mb-4 text-white bg-blue-600 rounded-lg">{{ __('messages.add_new_service') }}</a>
                    
                    @if(session('success'))
                        <div class="px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <table class="w-full mt-4 border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border">{{ __('messages.image') }}</th>
                                <th class="px-4 py-2 border">{{ __('messages.title') }}</th>
                                <th class="px-4 py-2 border">{{ __('messages.order') }}</th>
                                <th class="px-4 py-2 border">{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($services as $service)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2 text-center border">
                                    <img src="{{ asset('storage/' . $service->image) }}" 
                                         alt="{{ $service->title }}" 
                                         class="object-cover w-16 h-16 mx-auto border rounded-md">
                                </td>
                                <td class="px-4 py-2 border">{{ $service->title }}</td>
                                <td class="px-4 py-2 border">{{ $service->order }}</td>
                                <td class="px-4 py-2 border">
                                    <a href="{{ route('admin.services.edit', $service) }}" class="mr-3 text-blue-600 hover:underline">{{ __('messages.edit') }}</a>
                                    <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('messages.delete_this_service') }}')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">{{ __('messages.delete') }}</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-2 text-center text-gray-500">{{ __('messages.no_services_found') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>