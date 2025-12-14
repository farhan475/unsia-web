<?php

namespace App\Http\Controllers;

use App\Models\{User, Prodi};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        // Ambil data user yang role-nya 'dosen'
        // Eager load 'prodi' agar query efisien
        $dosens = User::where('role', 'dosen')
            ->with('prodi')
            ->when($request->search, function ($query) use ($request) {
                $query->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('nidn', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(10); // Pagination 10 baris per halaman

        // Ambil daftar prodi untuk dropdown di form tambah
        $prodis = Prodi::all();

        return view('pages.admin.dosen', compact('dosens', 'prodis'));
    }

    /**
     * Menyimpan dosen baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'password'     => 'required|string|max:20|min:8',
            'email'    => 'required|email|unique:users,email',
            'nidn'     => 'required|string|unique:users,nidn',
            'prodi_id' => 'required|exists:prodis,id',
        ]);

        User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'dosen',
            'nidn'     => $request->nidn,
            'prodi_id' => $request->prodi_id,
        ]);

        return back()->with('success', 'Dosen berhasil ditambahkan. Password default: 12345678');
    }

    /**
     * Menghapus data dosen.
     */
    public function destroy($id)
    {
        $dosen = User::findOrFail($id);

        // Opsional: Cek apakah dosen punya booking aktif sebelum hapus
        if ($dosen->bookings()->exists()) {
            return back()->with('error', 'Gagal hapus, dosen memiliki riwayat booking.');
        }

        $dosen->delete();

        return back()->with('success', 'Data dosen berhasil dihapus.');
    }
}
