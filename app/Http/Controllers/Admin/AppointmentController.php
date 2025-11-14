<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\RedirectResponse;

class AppointmentController extends Controller
{
    public function index()
    {
        $appointments = Appointment::with(['session.doctor', 'user'])
            ->latest()
            ->paginate(10);
            
        $pendingCount = Appointment::where('status', 'pending')->count();
        
        return view('admin.appointments.index', compact('appointments', 'pendingCount'));
    }

    public function show(Appointment $appointment)
    {
        $appointment->load(['session.doctor', 'user']);
        return view('admin.appointments.show', compact('appointment'));
    }

    public function destroy(Appointment $appointment): RedirectResponse
    {
        // Make session available again
        $session = $appointment->session;
        if ($session) {
            $session->update(['status' => 'available']);
        }
        
        $appointment->delete();
        
        return redirect()->route('admin.appointments.index')
            ->with('success', '❌ Appointment deleted and session made available!');
    }

    public function approve(Appointment $appointment): RedirectResponse
    {
        if (!$appointment->isPending()) {
            return back()->with('error', 'Appointment is not pending.');
        }

        // Approve appointment and book the session
        $appointment->update(['status' => 'approved']);
        
        if ($appointment->session) {
            $appointment->session->update(['status' => 'booked']);
        }

        return back()->with('success', '✅ Appointment approved and session booked!');
    }

    public function reject(Appointment $appointment): RedirectResponse
    {
        if (!$appointment->isPending()) {
            return back()->with('error', 'Appointment is not pending.');
        }

        // Reject appointment and make session available again
        $appointment->update(['status' => 'rejected']);
        
        if ($appointment->session) {
            $appointment->session->update(['status' => 'available']);
        }

        return back()->with('success', '❌ Appointment rejected and session made available!');
    }
}