<?php
namespace App\Http\Controllers;

use App\Models\{Booking, Video};
use Illuminate\Http\Request;

class WorkflowController extends Controller
{
    public function index()
    {
        // List semua booking untuk Admin, diurutkan berdasarkan status prioritas
        $bookings = Booking::with(['user.prodi', 'matkul'])
            ->orderByRaw("FIELD(status, 'Pending', 'Approved', 'Taping', 'Editing', 'Ready', 'Published', 'Rejected')")
            ->latest()
            ->get();

        // Statistik untuk widget dashboard admin
        $stats = [
            'pending' => Booking::where('status', 'Pending')->count(),
            'today'   => Booking::where('tanggal_taping', date('Y-m-d'))
                                ->where('status', 'Approved')->count(),
        ];

        return view('pages.admin.queue', compact('bookings', 'stats'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        // Logika Perpindahan Status Berdasarkan Tombol Aksi
        $status = match ($request->action) {
            'approve' => 'Approved',
            'reject'  => 'Rejected',
            'advance' => match ($booking->status) { // Logika maju ke status berikutnya
                'Approved' => 'Taping',
                'Taping'   => 'Editing',
                'Editing'  => 'Ready',
                default    => $booking->status // Status tidak berubah jika tidak sesuai
            },
            default => $booking->status
        };

        // Update status di database
        $booking->update(['status' => $status]);

        return back()->with('success', "Status berhasil diperbarui menjadi: $status");
    }

    public function publish(Request $request, Booking $booking)
    {
        // Validasi input link video dan judul
        $request->validate([
            'link_video' => 'required|url',
            'judul_final' => 'required|string',
        ]);

        // 1. Update status booking menjadi Published
        $booking->update(['status' => 'Published']);

        // 2. Buat entri baru di tabel Video Library
        Video::create([
            'booking_id'     => $booking->id,
            'judul_final'    => $request->judul_final,
            'link_video'     => $request->link_video,
            'tahun_akademik' => '2023/2024', // Bisa dibuat dinamis jika perlu
            'semester'       => 'Ganjil',   // Bisa dibuat dinamis jika perlu
            'views'          => 0
        ]);

        return back()->with('success', 'Video berhasil di-publish ke Library!');
    }
}