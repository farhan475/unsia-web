<?php

namespace App\Http\Controllers;

use App\Models\{Booking, Video};
use Illuminate\Http\Request;

class WorkflowController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user.prodi', 'matkul'])
            ->orderByRaw("FIELD(status, 'Pending', 'Approved', 'Taping', 'Editing', 'Ready', 'Published', 'Rejected')")->latest()->get();
        $stats = [
            'pending' => Booking::where('status', 'Pending')->count(),
            'today'   => Booking::whereDate('tanggal_taping', date('Y-m-d'))->where('status', 'Approved')->count(),
        ];
        return view('pages.admin.queue', compact('bookings', 'stats'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $status = match ($request->action) {
            'approve' => 'Approved',
            'reject'  => 'Rejected',
            'advance' => match ($booking->status) {
                'Approved' => 'Taping',
                'Taping'   => 'Editing',
                'Editing'  => 'Ready',
                default    => $booking->status,
            },
            default => $booking->status,
        };
        $booking->update(['status' => $status]);
        return back()->with('success', "Status berhasil diperbarui menjadi $status");
    }
    public function publish(Request $request, Booking $booking)
    {
        $request->validate([
            'link_video'  => 'required|url',
            'judul_final' => 'required|string',
        ]);
        $booking->update(['status' => 'Published']);
        Video::create([
            'booking_id'     => $booking->id,
            'judul'    => $request->judul_final,
            'link_video'     => $request->link_video,
            // 'semester'       => 'Ganjil',
            // 'views'          => 0,
        ]);
        return back()->with('success', 'Video berhasil dipublish ke Library');
    }
}
