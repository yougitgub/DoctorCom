<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\AppointmentSession;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class BookingController extends Controller
{
    public function index(): View
    {
        // Show ONLY available sessions to users
        $sessions = AppointmentSession::with('doctor')
            ->where('status', 'available')
            ->where('date_time', '>', now())
            ->orderBy('date_time')
            ->paginate(10);
            
        return view('frontend.sessions.index', compact('sessions'));
    }

    public function show(AppointmentSession $session): View
    {
        return view('frontend.sessions.show', compact('session'));
    }

    public function book(AppointmentSession $session): RedirectResponse
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('message', 'Please login to book a session.');
        }

        // Check if session is available
        if (!$session->isAvailable()) {
            return back()->with('error', '❌ This session is not available for booking.');
        }

        $user = Auth::user();

        // Create appointment (pending) and set session to pending
        $appointment = Appointment::create([
            'session_id' => $session->id,
            'doctor_id' => $session->doctor_id,
            'appointment_date' => $session->date_time,
            'user_id' => $user->id,
            'patient_name' => $user->name,
            'patient_email' => $user->email,
            'patient_phone' => $user->phone ?? 'N/A',
            'status' => 'pending',
        ]);

        $session->update(['status' => 'pending']);

        return redirect()->route('booking.confirmation', $appointment)
            ->with('success', '✅ Booking request submitted! Admin will approve shortly.');
    }

    public function confirmation(Appointment $appointment): View
    {
        return view('frontend.booking.confirmation', compact('appointment'));
    }
}