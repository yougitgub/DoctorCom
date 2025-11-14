<?php

// namespace App\Http\Controllers\Admin;

// use App\Http\Controllers\Controller;
// use App\Models\Doctor;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Storage;

// class DoctorController extends Controller
// {
//     public function index()
//     {
//         $doctor = Doctor::first();
//         return view('admin.doctor.index', compact('doctor'));
//     }

//     public function edit(Doctor $doctor)
//     {
//         return view('admin.doctor.edit', compact('doctor'));
//     }

//     public function update(Request $request, Doctor $doctor)
//     {
//         $validated = $request->validate([
//             'name' => 'required|string|max:255',
//             'specialty' => 'required|string|max:255',
//             'bio' => 'required|string',
//             'email' => 'required|email',
//             'phone' => 'required|string|max:20',
//             'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
//         ]);

//         if ($request->hasFile('photo')) {
//             if ($doctor->photo) Storage::disk('public')->delete($doctor->photo);
//             $validated['photo'] = $request->file('photo')->store('doctor', 'public');
//         }

//         $doctor->update($validated);
//         return redirect()->route('admin.doctor.index')->with('success', '✅ Doctor info updated!');
//     }
// }