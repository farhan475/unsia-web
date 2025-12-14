<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Redirect ke halaman spesifik berdasarkan role user
        if (Auth::user()->role === 'admin') {
            return redirect()->route('admin.queue'); // Ke antrian admin
        }
        // Jika dosen, redirect ke dashboard dosen / daftar booking
        return redirect()->route('bookings.index');
    }
}
