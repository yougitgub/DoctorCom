
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('messages.manage_sessions') }}
            @if($pendingCount > 0)
                <span class="px-3 py-1 ml-4 text-sm text-white bg-red-500 rounded-full">
                    {{ $pendingCount }} {{ __('messages.pending') }}
                </span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <a href="{{ route('admin.sessions.create') }}" class="inline-block px-4 py-2 mb-4 text-white bg-blue-600 rounded-lg">{{ __('messages.add_new_session') }}</a>
                    
                    @if(session('success'))
                        <div class="px-4 py-3 mb-4 text-green-700 bg-green-100 border border-green-400 rounded">{{ session('success') }}</div>
                    @endif

                    <table class="w-full mt-4 border-collapse">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 border">{{ __('messages.date_time') }}</th>
                                <th class="px-4 py-2 border">{{ __('messages.doctor') }}</th>
                                <th class="px-4 py-2 border">{{ __('messages.status') }}</th>
                                <th class="px-4 py-2 border">{{ __('messages.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($sessions as $session)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="px-4 py-2 border">{{ $session->date_time->format('M d, Y h:i A') }}</td>
                                <td class="px-4 py-2 border">{{ $session->doctor->name }}</td>
                                <td class="px-4 py-2 border">
                                    <span class="px-2 py-1 rounded text-xs 
                                        {{ $session->status === 'available' ? 'bg-green-100 text-green-800' : '' }}
                                        {{ $session->status === 'booked' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                        {{ $session->status === 'approved' ? 'bg-blue-100 text-blue-800' : '' }}
                                        {{ $session->status === 'rejected' ? 'bg-red-100 text-red-800' : '' }}
                                    ">
                                        @if($session->status === 'available')
                                            {{ __('messages.available') }}
                                        @elseif($session->status === 'booked')
                                            {{ __('messages.booked') }}
                                        @elseif($session->status === 'approved')
                                            {{ __('messages.approved') }}
                                        @elseif($session->status === 'rejected')
                                            {{ __('messages.rejected') }}
                                        @else
                                            {{ ucfirst($session->status) }}
                                        @endif
                                    </span>
                                </td>
                                
                                <td class="px-4 py-2 border">
                                    <a href="{{ route('admin.sessions.edit', $session) }}" class="text-blue-600">{{ __('messages.edit') }}</a>
                                    @if($session->appointment && $session->appointment->status === 'pending')
                                        <form action="{{ route('admin.sessions.approve', $session) }}" method="POST" class="inline ml-2">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="text-green-600">{{ __('messages.approve') }}</button>
                                        </form>
                                        <form action="{{ route('admin.sessions.reject', $session) }}" method="POST" class="inline ml-2">
                                            @csrf @method('PATCH')
                                            <button type="submit" class="text-red-600">{{ __('messages.reject') }}</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-4 py-2 text-center text-gray-500">{{ __('messages.no_sessions_found') }}</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>