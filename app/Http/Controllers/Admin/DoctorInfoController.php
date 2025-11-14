<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DoctorInfoController extends Controller
{
    /**
     * Show single doctor info edit form
     */
    public function edit(): View
    {
        $doctor = Doctor::findOrFail(1); // Always use doctor ID 1
        return view('admin.doctor.edit', compact('doctor'));
    
    }

    /**
     * Update single doctor info
     */
    public function update(Request $request): RedirectResponse
    {
        $doctor = Doctor::findOrFail(1);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'specialty' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
        ]);

        $doctor->update($validated);

        return redirect()->route('admin.dashboard')
            ->with('success', '✅ Doctor information updated successfully!');
    }
}