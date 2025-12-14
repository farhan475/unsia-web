<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function create()
    {
        $matkuls = Matkul::orderBy('nama_mk')->get();

        return view('pages.dosen.create', compact('matkuls'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matkul_id'      => 'required|exists:matkuls,id',
            'topik'          => 'required|string|max:255',
            'tanggal_taping' => 'required|date',
            'sesi'           => 'required|string|max:50',
        ]);

        Booking::create([
            'user_id'        => Auth::id(),
            'matkul_id'      => $request->matkul_id,
            // 'studio_id'      => null,
            'topik'          => $request->topik,
            'tanggal_taping' => $request->tanggal_taping,
            'sesi'           => $request->sesi,
            'status'         => 'Pending',
        ]);

        return redirect()
            ->route('dashboard')
            ->with('success', 'Pengajuan jadwal taping berhasil dikirim.');
    }
}
