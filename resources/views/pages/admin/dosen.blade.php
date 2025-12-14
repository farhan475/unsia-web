@extends('layouts.app')
@section('title', 'Manajemen Data Dosen')
@section('header_title', 'Data Dosen')
@section('content')
<div x-data="{ openModal: false }">
    <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
        <form action="{{ route('admin.dosen.index') }}" method="GET" class="relative w-full md:w-64">
            <input
                type="text"
                name="search"
                value="{{ request('search') }}"
                placeholder="Cari Nama / NIDN..."
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#00588a] focus:border-[#00588a] outline-none text-sm"
            >
            <i class="fa-solid fa-search absolute left-3 top-2.5 text-gray-400 text-sm"></i>
        </form>
        <button
            @click="openModal = true"
            class="bg-[#00588a] hover:bg-[#00466e] text-white px-4 py-2 rounded-lg text-sm font-bold shadow-sm transition flex items-center gap-2"
        >
            <i class="fa-solid fa-user-plus"></i>
            Tambah Dosen
        </button>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-200 text-xs text-gray-500 uppercase font-bold">
                    <tr>
                        <th class="px-6 py-4">Profil Dosen</th>
                        <th class="px-6 py-4">NIDN</th>
                        <th class="px-6 py-4">Program Studi</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($dosens as $dosen)
                        <tr class="hover:bg-gray-50 transition group">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-blue-50 text-[#00588a] flex items-center justify-center font-bold text-sm border border-blue-100">
                                        {{ substr($dosen->nama, 0, 1) }}
                                    </div>
                                    <span class="font-bold text-gray-800 text-sm">
                                        {{ $dosen->nama }}
                                    </span>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600 font-mono">
                                {{ $dosen->nidn }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded text-[10px] font-bold bg-gray-100 text-gray-600 border border-gray-200">
                                    {{ $dosen->prodi->nama ?? '-' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-sm text-gray-500">
                                {{ $dosen->email }}
                            </td>
                            <td class="px-6 py-4 text-right">
                                <form
                                    action="{{ route('admin.dosen.destroy', $dosen->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus dosen ini?');"
                                >
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-gray-400 hover:text-red-600 transition p-1" title="Hapus Dosen">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400 italic">
                                <div class="flex flex-col items-center">
                                    <i class="fa-solid fa-users-slash text-2xl mb-2"></i>
                                    Belum ada data dosen.
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $dosens->links() }}
        </div>
    </div>
    <div
        x-show="openModal"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm p-4"
        x-transition.opacity
        x-cloak
    >
        <div
            class="bg-white w-full max-w-lg rounded-xl shadow-2xl overflow-hidden transform transition-all"
            @click.outside="openModal = false"
        >
            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h3 class="font-bold text-gray-800 text-lg">Tambah Dosen Baru</h3>
                <button @click="openModal = false" class="text-gray-400 hover:text-red-500 transition">
                    <i class="fa-solid fa-xmark text-xl"></i>
                </button>
            </div>
            <form action="{{ route('admin.dosen.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
                    <input
                        type="text"
                        name="nama"
                        required
                        placeholder="Contoh: Dr. Budi Santoso, M.Kom"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#00588a] outline-none"
                    >
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">NIDN</label>
                        <input
                            type="text"
                            name="nidn"
                            required
                            placeholder="Nomor Induk"
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#00588a] outline-none"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1">Program Studi</label>
                        <select
                            name="prodi_id"
                            required
                            class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm bg-white focus:ring-2 focus:ring-[#00588a] outline-none"
                        >
                            <option value="">-- Pilih Prodi --</option>
                            @foreach($prodis as $prodi)
                                <option value="{{ $prodi->id }}">{{ $prodi->nama }} ({{ $prodi->kode }})</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Email Resmi</label>
                    <input
                        type="email"
                        name="email"
                        required
                        placeholder="nama@unsia.ac.id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#00588a] outline-none"
                    >
                </div>
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-1">Password</label>
                    <input
                        type="password"
                        name="password"
                        required
                        placeholder="Password"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 text-sm focus:ring-2 focus:ring-[#00588a] outline-none"
                    >
                </div>
                <div class="flex justify-end gap-3 pt-2">
                    <button
                        type="button"
                        @click="openModal = false"
                        class="px-4 py-2 rounded-lg text-sm font-bold text-gray-500 hover:bg-gray-100 transition"
                    >
                        Batal
                    </button>
                    <button
                        type="submit"
                        class="bg-[#00588a] text-white px-6 py-2 rounded-lg text-sm font-bold hover:bg-[#00466e] shadow transition"
                    >
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
