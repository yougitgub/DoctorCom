<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::firstOrCreate([
            'id' => 1
        ], [
            'content' => 'Edit this about section...',
            'image' => null
        ]);
        return view('admin.about.index', compact('about'));
    }

    public function edit(About $about)
    {
        return view('admin.about.edit', compact('about'));
    }

    public function update(Request $request, About $about)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($about->image) Storage::disk('public')->delete($about->image);
            $validated['image'] = $request->file('image')->store('about', 'public');
        }

        $about->update($validated);
        return redirect()->route('admin.about.index')->with('success', '✅ About section updated!');
    }
}