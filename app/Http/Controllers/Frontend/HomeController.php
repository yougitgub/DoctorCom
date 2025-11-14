<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sliders = \App\Models\Slider::where('is_active', true)->get();
        $services = \App\Models\Service::orderBy('order')->get();
        $about = \App\Models\About::first();
        $doctor = \App\Models\Doctor::first();
        
        // Show only next 3 available sessions on homepage
        $sessions = \App\Models\Session::with('doctor')
            ->where('status', 'available')
            ->where('date_time', '>', now())
            ->orderBy('date_time')
            ->limit(3)
            ->get();

        return view('welcome', compact('sliders', 'services', 'about', 'doctor', 'sessions'));
    }
}