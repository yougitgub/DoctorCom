<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - {{ __('messages.admin_dashboard') }}</title>
    @if(app()->getLocale() === 'ar')
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Noto Sans Arabic', sans-serif; }
        </style>
    @else
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    @endif
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased {{ app()->getLocale() === 'ar' ? 'rtl' : '' }}">
    <div class="min-h-screen bg-gray-100">
        <!-- Navigation -->
        <nav class="bg-white border-b border-gray-100 shadow">
            <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex">
                        <!-- Logo -->
                        <div class="flex items-center shrink-0">
                            <a href="{{ route('admin.dashboard') }}">
                                <div class="flex items-center justify-center bg-blue-600 rounded w-9 h-9">
                                    <span class="font-bold text-white text-sm sm:text-base">A</span>
                                </div>
                            </a>
                        </div>
                        <!-- Desktop Navigation Links -->
                        <div class="hidden space-x-4 sm:space-x-8 sm:-my-px sm:ml-6 sm:flex {{ app()->getLocale() === 'ar' ? 'space-x-reverse sm:mr-6 sm:ml-0' : '' }}">
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                <span class="text-sm sm:text-base">{{ __('messages.dashboard') }}</span>
                            </x-nav-link>
                            
                            <x-nav-link :href="route('admin.sliders.index')" :active="request()->routeIs('admin.sliders.*')">
                                <span class="text-sm sm:text-base">{{ __('messages.sliders') }}</span>
                            </x-nav-link>
                            <x-nav-link :href="route('admin.services.index')" :active="request()->routeIs('admin.services.*')">
                                <span class="text-sm sm:text-base">{{ __('messages.services') }}</span>
                            </x-nav-link>
                            <x-nav-link :href="route('admin.sessions.index')" :active="request()->routeIs('admin.sessions.*')">
                                <span class="text-sm sm:text-base">{{ __('messages.sessions') }}</span>
                            </x-nav-link>
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                                <span class="text-sm sm:text-base">{{ __('messages.website') }}</span>
                            </x-nav-link>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 sm:space-x-4 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                        {{-- Language Switcher --}}
                        <div class="relative hidden sm:block">
                            <button class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 transition {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}" onclick="toggleLanguage()">
                                <span class="text-xs sm:text-sm">{{ app()->getLocale() === 'en' ? 'EN' : 'AR' }}</span>
                                <svg class="w-3 h-3 sm:w-4 sm:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div id="languageDropdown" class="absolute z-50 hidden py-2 mt-2 bg-white rounded-md shadow-lg {{ app()->getLocale() === 'ar' ? 'left-0' : 'right-0' }} min-w-[120px]">
                                <a href="{{ route('language.switch', 'en') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ app()->getLocale() === 'en' ? 'bg-blue-50 text-blue-600' : '' }}">
                                   English
                                </a>
                                <a href="{{ route('language.switch', 'ar') }}" 
                                   class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 {{ app()->getLocale() === 'ar' ? 'bg-blue-50 text-blue-600' : '' }}">
                                   العربية
                                </a>
                            </div>
                        </div>
                        <span class="hidden sm:inline text-sm text-gray-600">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-red-600 hover:underline transition">{{ __('messages.logout') }}</button>
                        </form>
                        
                        <!-- Mobile Menu Button -->
                        <button id="adminMobileMenuButton" class="sm:hidden p-2 text-gray-700 hover:text-blue-600 focus:outline-none" onclick="toggleAdminMobileMenu()">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Mobile Navigation Menu -->
                <div id="adminMobileMenu" class="hidden sm:hidden pb-4 border-t border-gray-200">
                    <div class="flex flex-col space-y-2 pt-4 {{ app()->getLocale() === 'ar' ? 'space-y-reverse' : '' }}">
                        <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 text-sm {{ request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }} hover:bg-gray-50 rounded transition">
                            {{ __('messages.dashboard') }}
                        </a>
                        <a href="{{ route('admin.sliders.index') }}" class="px-3 py-2 text-sm {{ request()->routeIs('admin.sliders.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }} hover:bg-gray-50 rounded transition">
                            {{ __('messages.sliders') }}
                        </a>
                        <a href="{{ route('admin.services.index') }}" class="px-3 py-2 text-sm {{ request()->routeIs('admin.services.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }} hover:bg-gray-50 rounded transition">
                            {{ __('messages.services') }}
                        </a>
                        <a href="{{ route('admin.sessions.index') }}" class="px-3 py-2 text-sm {{ request()->routeIs('admin.sessions.*') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }} hover:bg-gray-50 rounded transition">
                            {{ __('messages.sessions') }}
                        </a>
                        <a href="{{ route('home') }}" class="px-3 py-2 text-sm {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-600' : 'text-gray-700' }} hover:bg-gray-50 rounded transition">
                            {{ __('messages.website') }}
                        </a>
                        
                        <div class="px-3 py-2 border-t border-gray-200 mt-2">
                            <div class="flex items-center justify-between mb-2">
                                <span class="text-xs text-gray-600">{{ __('messages.select_language') }}:</span>
                                <div class="flex space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                                    <a href="{{ route('language.switch', 'en') }}" 
                                       class="px-2 py-1 text-xs rounded {{ app()->getLocale() === 'en' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                                       EN
                                    </a>
                                    <a href="{{ route('language.switch', 'ar') }}" 
                                       class="px-2 py-1 text-xs rounded {{ app()->getLocale() === 'ar' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                                       AR
                                    </a>
                                </div>
                            </div>
                            <div class="text-xs text-gray-600 mb-2">{{ auth()->user()->name }}</div>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="w-full text-left px-3 py-2 text-sm font-medium text-red-600 hover:bg-red-50 rounded transition">
                                    {{ __('messages.logout') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            <div class="py-12">
                <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                   @yield('content', $slot ?? '')
                </div>
            </div>
        </main>
    </div>
    
    {{-- JavaScript for language dropdown and mobile menu --}}
    <script>
    function toggleLanguage() {
        const dropdown = document.getElementById('languageDropdown');
        if (dropdown) {
            dropdown.classList.toggle('hidden');
        }
    }
    
    function toggleAdminMobileMenu() {
        const menu = document.getElementById('adminMobileMenu');
        if (menu) {
            menu.classList.toggle('hidden');
        }
    }
    
    document.addEventListener('click', function(e) {
        const languageDropdown = document.getElementById('languageDropdown');
        if (languageDropdown && !e.target.closest('#languageDropdown') && !e.target.closest('button[onclick="toggleLanguage()"]')) {
            languageDropdown.classList.add('hidden');
        }
    });
    </script>
</body>
</html>