<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DoctorCom')</title>
     @if(app()->getLocale() === 'ar')
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Arabic:wght@400;600;700&display=swap" rel="stylesheet">
        <style>
            body { font-family: 'Noto Sans Arabic', sans-serif; }
            .rtl { text-align: right; }
        </style>
    @endif
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
<!-- Add to <head> section of welcome.blade.php -->
<style>
.swiper {
    width: 100%;
    height: 500px;
    border-radius: 12px;
    overflow: hidden;
}

.swiper-slide img {
    filter: brightness(0.7);
}

/* Custom Navigation Buttons */
.swiper-button-next,
.swiper-button-prev {
    color: white !important;
    background: rgba(0,0,0,0.3);
    padding: 20px;
    border-radius: 50%;
    width: 40px;
    height: 40px;
}

.swiper-button-next:after,
.swiper-button-prev:after {
    font-size: 20px;
}

.swiper-pagination-bullet {
    background: white !important;
    opacity: 0.5;
}

.swiper-pagination-bullet-active {
    opacity: 1;
}
</style>
</head>
<body class="{{ app()->getLocale() === 'ar' ? 'rtl' : '' }} bg-gray-50">
    <!-- Navigation -->
   <nav class="sticky top-0 z-50 bg-white shadow-lg">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="flex items-center justify-between h-16">
            <div class="flex items-center">
                <h1 class="text-xl font-bold text-blue-600 sm:text-2xl">DoctorCom</h1>
            </div>
            
            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-6 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                <a href="/#home" class="text-gray-700 transition hover:text-blue-600">{{ __('messages.home') }}</a>
                <a href="/#services" class="text-gray-700 transition hover:text-blue-600">{{ __('messages.services') }}</a>
                <a href="/#about" class="text-gray-700 transition hover:text-blue-600">{{ __('messages.about') }}</a>
                
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="px-3 py-1.5 text-sm text-white bg-red-600 rounded-lg hover:bg-red-700 transition">
                            {{ __('messages.admin_dashboard') }}
                        </a>
                    @endif
                    
                    <div class="flex items-center space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                        {{-- Language Switcher --}}
                        <div class="relative">
                            <button class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 transition {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}" onclick="toggleLanguage()">
                                <span class="text-sm">{{ app()->getLocale() === 'en' ? 'EN' : 'AR' }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        
                        <form method="POST" action="{{ route('logout') }}" class="inline">
                            @csrf
                            <button type="submit" class="text-sm font-medium text-gray-700 transition hover:text-red-600">{{ __('messages.logout') }}</button>
                        </form>
                    </div>
                @else
                    <div class="flex items-center space-x-3 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                        {{-- Language Switcher --}}
                        <div class="relative">
                            <button class="flex items-center space-x-1 text-gray-700 hover:text-blue-600 transition {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}" onclick="toggleLanguage()">
                                <span class="text-sm">{{ app()->getLocale() === 'en' ? 'EN' : 'AR' }}</span>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        
                        <a href="{{ route('login') }}" class="text-sm text-gray-700 transition hover:text-blue-600">{{ __('messages.login') }}</a>
                        <a href="{{ route('register') }}" class="px-3 py-1.5 text-sm text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">{{ __('messages.register') }}</a>
                    </div>
                @endauth
            </div>
            
            <!-- Mobile Menu Button -->
            <button id="mobileMenuButton" class="p-2 text-gray-700 md:hidden hover:text-blue-600 focus:outline-none" onclick="toggleMobileMenu()">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        
        <!-- Mobile Navigation Menu -->
        <div id="mobileMenu" class="hidden pb-4 mt-2 border-t border-gray-200 md:hidden">
            <div class="flex flex-col space-y-3 pt-4 {{ app()->getLocale() === 'ar' ? 'space-y-reverse' : '' }}">
                <a href="/#home" class="px-3 py-2 text-gray-700 transition rounded hover:text-blue-600 hover:bg-gray-50">{{ __('messages.home') }}</a>
                <a href="/#services" class="px-3 py-2 text-gray-700 transition rounded hover:text-blue-600 hover:bg-gray-50">{{ __('messages.services') }}</a>
                <a href="/#about" class="px-3 py-2 text-gray-700 transition rounded hover:text-blue-600 hover:bg-gray-50">{{ __('messages.about') }}</a>
                
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="px-3 py-2 text-white transition bg-red-600 rounded-lg hover:bg-red-700">
                            {{ __('messages.admin_dashboard') }}
                        </a>
                    @endif
                    
                    <div class="px-3 py-2">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">{{ __('messages.select_language') }}:</span>
                            <div class="flex space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                                <a href="{{ route('language.switch', 'en') }}" 
                                   class="px-3 py-1 text-xs rounded {{ app()->getLocale() === 'en' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                                   EN
                                </a>
                                <a href="{{ route('language.switch', 'ar') }}" 
                                   class="px-3 py-1 text-xs rounded {{ app()->getLocale() === 'ar' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                                   AR
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <form method="POST" action="{{ route('logout') }}" class="px-3">
                        @csrf
                        <button type="submit" class="w-full px-3 py-2 text-sm font-medium text-left text-gray-700 transition rounded hover:text-red-600 hover:bg-gray-50">{{ __('messages.logout') }}</button>
                    </form>
                @else
                    <div class="px-3 py-2">
                        <div class="flex items-center justify-between mb-3">
                            <span class="text-sm text-gray-600">{{ __('messages.select_language') }}:</span>
                            <div class="flex space-x-2 {{ app()->getLocale() === 'ar' ? 'space-x-reverse' : '' }}">
                                <a href="{{ route('language.switch', 'en') }}" 
                                   class="px-3 py-1 text-xs rounded {{ app()->getLocale() === 'en' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                                   EN
                                </a>
                                <a href="{{ route('language.switch', 'ar') }}" 
                                   class="px-3 py-1 text-xs rounded {{ app()->getLocale() === 'ar' ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700' }}">
                                   AR
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-col space-y-2">
                            <a href="{{ route('login') }}" class="w-full px-3 py-2 text-center text-gray-700 transition rounded hover:text-blue-600 hover:bg-gray-50">{{ __('messages.login') }}</a>
                            <a href="{{ route('register') }}" class="w-full px-3 py-2 text-center text-white transition bg-blue-600 rounded-lg hover:bg-blue-700">{{ __('messages.register') }}</a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</nav>

{{-- JavaScript for mobile menu and language dropdown --}}
<script>
function toggleMobileMenu() {
    const menu = document.getElementById('mobileMenu');
    menu.classList.toggle('hidden');
}

function toggleLanguage() {
    const dropdown = document.getElementById('languageDropdown');
    if (dropdown) {
        dropdown.classList.toggle('hidden');
    }
}

document.addEventListener('click', function(e) {
    const languageDropdown = document.getElementById('languageDropdown');
    if (languageDropdown && !e.target.closest('#languageDropdown') && !e.target.closest('button[onclick="toggleLanguage()"]')) {
        languageDropdown.classList.add('hidden');
    }
});
</script>
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-6 mt-12 text-white bg-gray-800 sm:py-8 sm:mt-16">
        <div class="px-4 mx-auto text-center max-w-7xl">
            <p class="text-sm sm:text-base">&copy; 2025 DoctorCom. {{ __('messages.all_rights_reserved') }}</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    @stack('scripts')
</body>
</html>