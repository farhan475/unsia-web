<?php
namespace App\Http\Controllers;

use App\Models\{Video, Prodi, Matkul}; // Perlu Model Prodi & Matkul untuk Filter
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function index(Request $request)
    {
        $videos = Video::with(['booking.user.prodi', 'booking.matkul'])
            ->when($request->filled('tahun_akademik'), function($q) use ($request) {
                $q->where('tahun_ajar', $request->tahun_akademik);
            })
            ->when($request->filled('semester'), function($q) use ($request) {
                $q->where('semester', $request->semester);
            })
            ->when($request->filled('prodi_id'), function($q) use ($request) {
                // Filter berdasarkan Prodi Dosen yang terhubung ke booking
                $q->whereHas('booking.user.prodi', function($query) use ($request) {
                    $query->where('prodi_id', $request->prodi_id);
                });
            })
            ->latest()
            ->paginate(12);

        $prodis = Prodi::all(); // Untuk dropdown filter
        $matkuls = Matkul::all(); // Jika perlu filter matkul juga

        return view('pages.library', compact('videos', 'prodis', 'matkuls'));
    }
}