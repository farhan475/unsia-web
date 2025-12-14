<?php

namespace App\Http\Controllers;

use App\Models\{Booking, Video};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'admin') {
            return $this->adminDashboard();
        }

        return $this->dosenDashboard($user);
    }

    public function adminIndex()
    {
        // dipakai route admin.dashboard
        return $this->adminDashboard();
    }

    private function dosenDashboard($user)
    {
        $stats = [
            'video_saya' => Video::whereHas('booking', fn($q) => $q->where('user_id', $user->id))->count(),
            'pending'    => Booking::where('user_id', $user->id)->where('status', 'Pending')->count(),
            'approved'   => Booking::where('user_id', $user->id)->whereIn('status', ['Approved', 'Taping'])->count(),
        ];

        $nextSchedule = Booking::where('user_id', $user->id)
            ->whereIn('status', ['Approved', 'Taping'])
            ->whereDate('tanggal_taping', '>=', now())
            ->with('matkul')
            ->orderBy('tanggal_taping', 'asc')
            ->first();

        $calendarData = Booking::whereMonth('tanggal_taping', now()->month)
            ->whereYear('tanggal_taping', now()->year)
            ->get()
            ->groupBy(function ($booking) {
                return $booking->tanggal_taping->format('Y-m-d'); // kunci = string tanggal
            });

        return view('pages.dosen.dashboard', compact('stats', 'nextSchedule', 'calendarData'));
    }

    private function adminDashboard()
    {
        $stats = [
            'pending'      => Booking::where('status', 'Pending')->count(),
            'taping_today' => Booking::whereDate('tanggal_taping', now())
                ->where('status', 'Approved')
                ->count(),
            'editing'      => Booking::where('status', 'Editing')->count(),
            'total_video'  => Video::count(),
        ];

        $bookings = Booking::with(['user.prodi', 'matkul'])
            ->latest()
            ->get();

        return view('pages.admin.dashboard', compact('stats', 'bookings'));
    }
}
