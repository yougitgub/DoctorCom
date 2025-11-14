<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function index()
    {
        $sessions = Session::with(['doctor', 'appointment.user'])->latest()->paginate(10);
        $pendingCount = Appointment::where('status', 'pending')->count();
        return view('admin.sessions.index', compact('sessions', 'pendingCount'));
    }

    public function create()
    {
        $doctors = Doctor::all();
        return view('admin.sessions.create', compact('doctors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date_time' => 'required|date|after:now',
        ]);

        Session::create($validated);
        return redirect()->route('admin.sessions.index')->with('success', 'Session created!');
    }

    public function edit(Session $session)
    {
        $doctors = Doctor::all();
        return view('admin.sessions.edit', compact('session', 'doctors'));
    }

    public function update(Request $request, Session $session)
    {
        $validated = $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'date_time' => 'required|date|after:now',
            'status' => 'required|in:available,booked,approved,rejected,completed',
        ]);

        $session->update($validated);
        return redirect()->route('admin.sessions.index')->with('success', 'Session updated!');
    }

    public function destroy(Session $session)
    {
        $session->delete();
        return back()->with('success', 'Session deleted!');
    }

    public function approve(Session $session)
    {
        if ($session->appointment && $session->appointment->status === 'pending') {
            $session->appointment->update(['status' => 'approved']);
            $session->update(['status' => 'approved']);
            return back()->with('success', 'Appointment approved!');
        }
        return back()->with('error', 'Invalid action.');
    }

    public function reject(Session $session)
    {
        if ($session->appointment && $session->appointment->status === 'pending') {
            $session->appointment->update(['status' => 'rejected']);
            $session->update(['status' => 'available']);
            return back()->with('success', 'Appointment rejected. Session is available again.');
        }
        return back()->with('error', 'Invalid action.');
    }
}