<?php

use App\Http\Controllers\Admin\{
    DashboardController,
    DoctorController,
    SliderController,
    ServiceController,
    AboutController,
    AppointmentSessionController,
    AppointmentController
};
use App\Http\Controllers\Frontend\{
    HomeController,
    BookingController
};
use App\Http\Controllers\Admin\DoctorInfoController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
        app()->setLocale($locale);
        // Ensure session is saved
        session()->save();
    }
    return redirect()->back()->with('locale_changed', true);
})->name('language.switch');


// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/sessions', [BookingController::class, 'index'])->name('booking.sessions');

// Authentication Routes
Route::middleware('auth')->group(function () {
    Route::post('/sessions/{session}/book', [BookingController::class, 'book'])->name('booking.book');
    Route::get('/appointments/{appointment}/confirmation', [BookingController::class, 'confirmation'])->name('booking.confirmation');
    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
// Admin Routes - Protected by auth and admin role
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('appointments', AppointmentController::class)->only(['index', 'show', 'destroy']);
    Route::get('/doctor/edit', [DoctorInfoController::class, 'edit'])->name('doctor.edit');
    Route::put('/doctor/update', [DoctorInfoController::class, 'update'])->name('doctor.update');
    // Add these two lines
    Route::patch('/appointments/{appointment}/approve', [AppointmentController::class, 'approve'])
        ->name('appointments.approve');
    Route::patch('/appointments/{appointment}/reject', [AppointmentController::class, 'reject'])
        ->name('appointments.reject');
    // Dashboard (fix: removed duplicate 'admin' in path)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Full CRUD Resources
    Route::resource('sliders', SliderController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('sessions', AppointmentSessionController::class);
    Route::resource('appointments', AppointmentController::class)->only(['index', 'show', 'destroy']);
    // Route::resource('doctor', DoctorInfoController::class);
    
    // About Section
    Route::get('/about', [AboutController::class, 'index'])->name('about.index');
    Route::get('/about/edit/{about}', [AboutController::class, 'edit'])->name('about.edit');
    Route::put('/about/update/{about}', [AboutController::class, 'update'])->name('about.update');
    
    // Session Actions
    Route::patch('/sessions/{session}/approve', [AppointmentSessionController::class, 'approve'])->name('sessions.approve');
    Route::patch('/sessions/{session}/reject', [AppointmentSessionController::class, 'reject'])->name('sessions.reject');

 
});

require __DIR__.'/auth.php';