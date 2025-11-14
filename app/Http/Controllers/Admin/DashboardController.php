<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $pendingCount = Appointment::where('status', 'pending')->count();
        return view('admin.dashboard', compact('pendingCount'));
    }
}