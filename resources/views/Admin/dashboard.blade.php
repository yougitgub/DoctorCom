<x-app-layout>
    <x-slot name="header">
        <h2 class="text-lg sm:text-xl font-semibold leading-tight text-gray-800">
            {{ __('messages.admin_dashboard') }} 
            @if($pendingCount > 0)
                <span class="px-2 sm:px-3 py-1 ml-2 sm:ml-4 text-xs sm:text-sm text-white bg-red-500 rounded-full">
                    {{ $pendingCount }} {{ __('messages.new_bookings') }}
                </span>
            @endif
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-3 sm:gap-4 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <a href="{{ route('admin.sessions.index') }}" class="block p-4 sm:p-6 bg-blue-100 rounded-lg hover:bg-blue-200 transition">
                    <h3 class="text-base sm:text-lg font-bold">{{ __('messages.sessions') }}</h3>
                    <p class="text-sm sm:text-base">{{ __('messages.manage_time_slots') }}</p>
                </a>
                <a href="{{ route('admin.appointments.index') }}" class="relative block p-4 sm:p-6 bg-green-100 rounded-lg hover:bg-green-200 transition">
                    <h3 class="text-base sm:text-lg font-bold">{{ __('messages.appointments') }}</h3>
                    <p class="text-sm sm:text-base">{{ __('messages.review_bookings') }}</p>
                    @if($pendingCount > 0)
                        <span class="absolute flex items-center justify-center w-5 h-5 sm:w-6 sm:h-6 text-xs text-white bg-red-500 rounded-full top-2 right-2">{{ $pendingCount }}</span>
                    @endif
                </a>
                <a href="{{ route('admin.doctor.edit') }}" class="block p-4 sm:p-6 bg-yellow-100 rounded-lg hover:bg-yellow-200 transition">
                    <h3 class="text-base sm:text-lg font-bold">{{ __('messages.doctor_info') }}</h3>
                    <p class="text-sm sm:text-base">{{ __('messages.update_details') }}</p>
                </a>
                <a href="{{ route('admin.about.index') }}" class="block p-4 sm:p-6 bg-purple-100 rounded-lg hover:bg-purple-200 transition">
                    <h3 class="text-base sm:text-lg font-bold">{{ __('messages.about_section') }}</h3>
                    <p class="text-sm sm:text-base">{{ __('messages.doctors_info') }}</p>
                </a>
                <a href="{{ route('admin.sliders.index') }}" class="block p-4 sm:p-6 rounded-lg bg-slate-400 hover:bg-slate-500 transition">
                    <h3 class="text-base sm:text-lg font-bold">{{ __('messages.sliders') }}</h3>
                    <p class="text-sm sm:text-base">{{ __('messages.manage_slides_content') }}</p>
                </a>
                <a href="{{ route('admin.services.index') }}" class="block p-4 sm:p-6 rounded-lg bg-neutral-200 hover:bg-neutral-500 transition">
                    <h3 class="text-base sm:text-lg font-bold">{{ __('messages.services') }}</h3>
                    <p class="text-sm sm:text-base">{{ __('messages.manage_services_content') }}</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>