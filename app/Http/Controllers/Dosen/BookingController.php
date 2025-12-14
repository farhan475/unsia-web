<?php
namespace App\Http\Controllers;

use App\Models\{Booking, Matkul, Studio}; // Perlu Model Matkul & Studio
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Statistik Ringkas untuk Dosen
        $stats = [
            'total_videos' => $user->bookings()->where('status', 'Published')->count(),
            'pending'      => $user->bookings()->where('status', 'Pending')->count(),
            'approved'     => $user->bookings()->whereIn('status', ['Approved', 'Taping'])->count(),
        ];

        // Ambil daftar booking user yang login
        $bookings = $user->bookings()->with(['matkul', 'studio'])->latest()->get();

        return view('pages.dosen.dashboard', compact('bookings', 'stats'));
    }

    public function create()
    {
        // Ambil Mata Kuliah berdasarkan Prodi Dosen agar Autosearch relevan
        $matkuls = Matkul::where('prodi_id', Auth::user()->prodi_id)->get();
        
        return view('pages.dosen.create', compact('matkuls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matkul_id'      => 'required|exists:matkuls,id',
            'topik'          => 'required|string',
            'tanggal_taping' => 'required|date|after_or_equal:today', // Tidak boleh tanggal lampau
            'sesi'           => 'required',
        ]);

        // Cek Bentrok Jadwal (Booking yang Approved/Taping di hari & sesi yang sama)
        $isBentrok = Booking::where('tanggal_taping', $request->tanggal_taping)
                    ->where('sesi', $request->sesi)
                    ->whereIn('status', ['Approved', 'Taping'])
                    ->exists();

        if ($isBentrok) {
            return back()->with('error', 'Slot waktu tersebut sudah penuh! Silakan pilih sesi lain.');
        }

        Booking::create([
            'user_id'        => Auth::id(),
            'matkul_id'      => $request->matkul_id,
            'topik'          => $request->topik,
            'tanggal_taping' => $request->tanggal_taping,
            'sesi'           => $request->sesi,
            'studio_id'      => 1, // Default ke Studio 1
            'status'         => 'Pending'
        ]);

        return redirect()->route('bookings.index')->with('success', 'Pengajuan berhasil dikirim. Menunggu persetujuan Admin.');
    }
}