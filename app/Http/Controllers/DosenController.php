<?php

namespace App\Http\Controllers;

use App\Models\{User, Prodi};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DosenController extends Controller
{
    public function index(Request $request)
    {
        $dosens = User::where('role', 'dosen')
            ->with('prodi')
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('nama', 'like', '%' . $request->search . '%')
                        ->orWhere('nidn', 'like', '%' . $request->search . '%');
                });
            })
            ->latest()
            ->paginate(10);

        $prodis = Prodi::all();

        return view('pages.admin.dosen', compact('dosens', 'prodis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'      => 'required|string|max:255',
            'password'  => 'required|string|max:20|min:8',
            'email'     => 'required|email|unique:users,email',
            'nidn'      => 'required|string|unique:users,nidn',
            'prodi_id'  => 'required|exists:prodis,id',
        ]);

        User::create([
            'nama'     => $request->nama,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'dosen',
            'nidn'     => $request->nidn,
            'prodi_id' => $request->prodi_id,
        ]);

        return back()->with('success', 'Dosen berhasil ditambahkan');
    }

    public function destroy($id)
    {
        $dosen = User::findOrFail($id);

        // if ($dosen->bookings()->exists()) {
        //     return back()->with('error', 'Gagal hapus, dosen memiliki riwayat booking');
        // }

        $dosen->delete();

        return back()->with('success', 'Data dosen berhasil dihapus');
    }
}
