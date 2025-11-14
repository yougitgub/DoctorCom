@extends('layouts.frontend')

@section('content')
<!-- HERO SLIDER - BULLETPROOF -->
<section id="home" class="relative w-full h-screen bg-blue-50">
    @if($sliders->isNotEmpty())
        <div class="w-full h-full swiper-container" id="hero-slider">
            <div class="swiper-wrapper">
                @foreach($sliders as $slider)
                <div class="relative swiper-slide">
                    @if($slider->image && file_exists(public_path('storage/' . $slider->image)))
                        <img src="{{ asset('storage/' . $slider->image) }}" 
                             class="object-cover w-full h-full" 
                             alt="{{ $slider->title }}"
                             loading="eager"
                             onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <div class="flex items-center justify-center hidden w-full h-full bg-gradient-to-br from-blue-600 to-blue-800">
                            <div class="text-center text-white">
                                <h3 class="text-2xl font-bold">{{ __('messages.image_error') }}</h3>
                            </div>
                        </div>
                    @else
                        <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-blue-600 to-blue-800">
                            <div class="text-center text-white">
                                <h3 class="text-2xl font-bold">{{ $slider->title }}</h3>
                            </div>
                        </div>
                    @endif
                    
                    <div class="absolute inset-0 flex items-center justify-center bg-gradient-to-r from-black/70 via-black/40 to-black/70">
                        <div class="max-w-6xl px-4 text-center text-white">
                            <h2 class="mb-3 sm:mb-6 text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-bold drop-shadow-2xl">{{ $slider->title }}</h2>
                            <p class="text-base sm:text-xl md:text-2xl lg:text-3xl drop-shadow-xl">{{ $slider->description }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
            
            <!-- Navigation -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    @else
        <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-blue-600 to-blue-800">
            <div class="text-center text-white">
                <h2 class="mb-4 text-4xl font-bold">{{ __('messages.welcome_to_doctorcom') }}</h2>
                <p class="text-xl">{{ __('messages.no_slides_configured') }}</p>
            </div>
        </div>
    @endif
</section>

<!-- Swiper CSS & JS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<style>
/* Critical: Force correct dimensions */
.swiper-container { width: 100%; height: 100vh !important; position: relative; z-index: 1; }

/* Transparent Arrows */
.swiper-button-prev, .swiper-button-next {
    width: 50px !important; height: 50px !important;
    background: rgba(59, 130, 246, 0.4) !important;
    border-radius: 50% !important; border: 1px solid rgba(255,255,255,0.5);
    transition: all 0.3s ease; z-index: 10;
}
.swiper-button-prev:hover, .swiper-button-next:hover { background: rgba(37, 99, 235, 0.6) !important; }
.swiper-button-prev:after, .swiper-button-next:after { font-size: 20px !important; color: white; font-weight: bold; }
.swiper-button-prev { left: 50px !important; }
.swiper-button-next { right: 50px !important; }

/* Pagination */
.swiper-pagination { z-index: 10; }
.swiper-pagination-bullet { width: 14px !important; height: 14px !important; background: rgba(255,255,255,0.5) !important; }
.swiper-pagination-bullet-active { background: #3B82F6 !important; width: 40px !important; border-radius: 7px !important; }

/* Mobile Responsive */
@media (max-width: 768px) {
    .swiper-container { height: 60vh !important; min-height: 300px; }
    .swiper-button-prev, .swiper-button-next { 
        width: 35px !important; 
        height: 35px !important; 
    }
    .swiper-button-prev { left: 10px !important; }
    .swiper-button-next { right: 10px !important; }
    .swiper-button-prev:after, .swiper-button-next:after { font-size: 16px !important; }
}

@media (max-width: 640px) {
    .swiper-container { height: 50vh !important; min-height: 250px; }
    .swiper-button-prev, .swiper-button-next { 
        width: 30px !important; 
        height: 30px !important; 
    }
    .swiper-button-prev { left: 5px !important; }
    .swiper-button-next { right: 5px !important; }
}
</style>

<script>
// Force initialization after everything loads
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(() => {
        try {
            const swiper = new Swiper('.swiper-container', {
                loop: true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                    pauseOnMouseEnter: true,
                },
                pagination: {
                    el: '.swiper-pagination',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next',
                    prevEl: '.swiper-button-prev',
                },
                effect: 'fade',
                fadeEffect: { crossFade: true },
                speed: 800,
                observer: true,
                observeParents: true,
                on: {
                    init: () => console.log('Swiper loaded'),
                    slideChange: () => console.log('Slide changed'),
                }
            });
            
            // Emergency reinit if stuck
            setTimeout(() => {
                if (swiper.slides.length === 0) {
                    console.warn('Emergency reinit');
                    swiper.update();
                    swiper.autoplay.start();
                }
            }, 3000);
            
        } catch (e) {
            console.error('Swiper Error:', e);
        }
    }, 500); // 500ms delay
});
</script>

<!-- Services -->
<section id="services" class="py-8 sm:py-12 md:py-16">
    <div class="px-4 mx-auto max-w-7xl">
        <h2 class="mb-6 sm:mb-8 md:mb-12 text-2xl sm:text-3xl font-bold text-center">{{ __('messages.our_services') }}</h2>
        <div class="grid grid-cols-1 gap-4 sm:gap-6 md:gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($services as $service)
            <div class="p-6 text-center transition bg-white rounded-lg shadow-md hover:shadow-lg">
                <div class="mb-4 text-4xl text-blue-600">
                    <img src=" {{ asset('storage/' . $service->image) }}" 
                         alt="{{ $service->title }}" 
                         class="object-cover w-20 h-20 mx-auto border rounded-md">
                </div>
                <h3 class="mb-2 text-xl font-semibold">{{ $service->title }}</h3>
                <p class="text-gray-600">{{ $service->description }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

<!-- About -->
<section id="about" class="py-8 sm:py-12 md:py-16 bg-gray-100">
    <div class="px-4 mx-auto max-w-7xl">
        <div class="grid items-center grid-cols-1 gap-6 sm:gap-8 md:gap-12 lg:grid-cols-2">
            <div class="order-2 lg:order-1">
                <h2 class="mb-4 sm:mb-6 text-2xl sm:text-3xl font-bold">{{ __('messages.about_doctor') }} {{ $doctor->name }}</h2>
                <p class="mb-4 text-sm sm:text-base text-gray-600">{{ $doctor->bio }}</p>
                <div class="space-y-2 text-sm sm:text-base">
                    <p><strong>{{ __('messages.specialty') }}:</strong> {{ $doctor->specialty }}</p>
                    <p><strong>{{ __('messages.email') }}:</strong> {{ $doctor->email }}</p>
                    <p><strong>{{ __('messages.phone') }}:</strong> {{ $doctor->phone }}</p>
                </div>
            </div>
            <div class="order-1 lg:order-2">
                @if($about && $about->image)
                    <img src="{{ asset('storage/' . $about->image) }}" class="w-full rounded-lg shadow-md">
                @endif
            </div>
        </div>
        @if($about)
            <div class="mt-8 prose max-w-none">
                {!! $about->content !!}
            </div>
        @endif
    </div>
</section>

<!-- Available Sessions -->
<section class="py-8 sm:py-12 md:py-16">
    <div class="px-4 mx-auto max-w-7xl">
        <h2 class="mb-6 sm:mb-8 text-2xl sm:text-3xl font-bold text-center">{{ __('messages.upcoming_available_sessions') }}</h2>
        
        @guest
            <div class="px-4 py-3 mb-4 sm:mb-6 text-sm sm:text-base text-center text-yellow-700 bg-yellow-100 border border-yellow-400 rounded">
                {{ __('messages.please_login_to_book') }} <a href="{{ url('/login') }}" class="font-semibold underline">{{ __('messages.login') }}</a> {{ __('messages.to_book_a_session') }}
            </div>
        @endguest

        <div class="grid grid-cols-1 gap-4 sm:gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($sessions as $session)
            <div class="p-4 sm:p-6 bg-white rounded-lg shadow-md hover:shadow-lg transition">
                <h3 class="mb-2 text-base sm:text-lg font-semibold">{{ $session->date_time->format('M d, Y h:i A') }}</h3>
                <p class="mb-4 text-sm sm:text-base text-gray-600">{{ $session->doctor->name }} - {{ $session->doctor->specialty }}</p>
                @auth
                    <form action="{{ route('booking.book', $session) }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full py-2 text-sm sm:text-base text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition">
                            {{ __('messages.book_now') }}
                        </button>
                    </form>
                @else
                    <a href="{{ url('/login') }}" class="block w-full py-2 text-sm sm:text-base text-center text-white bg-gray-400 rounded-lg hover:bg-gray-500 transition">
                        {{ __('messages.login_to_book') }}
                    </a>
                @endauth
            </div>
            @empty
            <div class="py-12 text-center col-span-full">
                <p class="text-gray-600">{{ __('messages.no_sessions_available') }}</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

@endsection