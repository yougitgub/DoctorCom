<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppointmentSession;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class AppointmentSessionController extends Controller
{
    public function index(): View
    {
        $sessions = AppointmentSession::with('doctor')->latest()->paginate(10);
        
        // ✅ FIXED: Count pending appointments
        $pendingCount = Appointment::where('status', 'pending')->count();
        
        // ✅ FIXED: Pass BOTH variables to view
        return view('admin.sessions.index', compact('sessions', 'pendingCount'));
    }

    public function create(): View
    {
        return view('admin.sessions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'date_time' => 'required|date|after:now',
            'status' => 'required|in:available,booked,pending,approved,rejected,completed',
        ]);

        // Auto-assign the single doctor
        $validated['doctor_id'] = 1;

        AppointmentSession::create($validated);
        
        return redirect()->route('admin.sessions.index')
            ->with('success', '✅ Session created successfully!');
    }

    public function edit(AppointmentSession $session): View
    {
        return view('admin.sessions.edit', compact('session'));
    }

    public function update(Request $request, AppointmentSession $session): RedirectResponse
    {
        $validated = $request->validate([
            'date_time' => 'required|date|after:now',
            'status' => 'required|in:available,booked,pending,approved,rejected,completed',
        ]);

        $session->update($validated);
        
        return redirect()->route('admin.sessions.index')
            ->with('success', '✅ Session updated successfully!');
    }

    public function destroy(AppointmentSession $session): RedirectResponse
    {
        $session->delete();
        return back()->with('success', '❌ Session deleted successfully!');
    }
}