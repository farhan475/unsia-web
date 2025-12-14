<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        // Ambil semua booking, urutkan pending paling atas
        $bookings = Booking::with(['user.prodi', 'matkul'])
            ->orderByRaw("FIELD(status, 'Pending', 'Approved', 'Taping', 'Editing', 'Ready', 'Published', 'Rejected')")
            ->latest()
            ->get();

        return view('admin.dashboard', compact('bookings'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        // Logic perubahan status (Pending -> Approved -> Taping -> dll)
        $booking->update(['status' => $request->status]);
        return back()->with('success', 'Status berhasil diperbarui!');
    }
}
