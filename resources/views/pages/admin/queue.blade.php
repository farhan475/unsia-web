@extends('components.layout')
@section('title', 'Antrian Produksi Studio')
@section('header_title', 'Antrian Produksi')

@section('content')
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Card 1: Permintaan Baru -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div><p class="text-sm font-medium text-gray-500">Permintaan Baru</p><p class="text-3xl font-bold text-gray-800">{{ $stats['pending'] }}</p></div>
        <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-lg flex items-center justify-center text-xl"><i class="fa-solid fa-inbox"></i></div>
    </div>
    <!-- Card 2: Taping Hari Ini -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div><p class="text-sm font-medium text-gray-500">Taping Hari Ini</p><p class="text-3xl font-bold text-gray-800">{{ $stats['today'] }}</p></div>
        <div class="w-12 h-12 bg-blue-50 text-[#00588a] rounded-lg flex items-center justify-center text-xl"><i class="fa-solid fa-video"></i></div>
    </div>
    <!-- Card 3: Sedang Diedit -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div><p class="text-sm font-medium text-gray-500">Sedang Diedit</p><p class="text-3xl font-bold text-gray-800">4</p></div>
        <div class="w-12 h-12 bg-orange-50 text-orange-600 rounded-lg flex items-center justify-center text-xl"><i class="fa-solid fa-scissors"></i></div>
    </div>
    <!-- Card 4: Total Video -->
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex items-center justify-between">
        <div><p class="text-sm font-medium text-gray-500">Total Video</p><p class="text-3xl font-bold text-gray-800">15</p></div>
        <div class="w-12 h-12 bg-green-50 text-green-600 rounded-lg flex items-center justify-center text-xl"><i class="fa-brands fa-youtube"></i></div>
    </div>
</div>

<!-- Tabel Antrian Produksi -->
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-6 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
        <h3 class="font-bold text-gray-800">Daftar Antrian Produksi</h3>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200 text-xs text-gray-500 uppercase font-bold">
                <tr>
                    <th class="px-6 py-3">Project Info</th>
                    <th class="px-6 py-3">Jadwal</th>
                    <th class="px-6 py-3 text-center">Status</th>
                    <th class="px-6 py-3 text-right">Aksi Admin</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($bookings as $item)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-bold text-gray-800 text-sm">{{ $item->matkul->nama_mk }}</div>
                            <div class="text-xs text-gray-500">{{ $item->topik }}</div>
                            <div class="mt-1.5 inline-flex items-center gap-1 bg-blue-50 text-[#00588a] px-2 py-0.5 rounded text-[10px] font-bold border border-blue-100">
                                <i class="fa-solid fa-user"></i> {{ $item->user->name }}
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="font-medium text-gray-800">{{ $item->tanggal_taping->format('d M Y') }}</div>
                            <div class="text-gray-500 text-xs">{{ $item->sesi }}</div>
                        </td>
                        <td class="px-6 py-4 text-center">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wide {{ $item->status_badge }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <!-- Tombol Aksi Berdasarkan Status -->
                            @if($item->status == 'Pending')
                                <form action="{{ route('admin.workflow.update', $item->id) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="action" value="approve">
                                    <button class="bg-blue-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-blue-700 shadow-sm transition">Approve</button>
                                </form>
                                <form action="{{ route('admin.workflow.update', $item->id) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="action" value="reject">
                                    <button class="bg-white text-red-600 border border-red-200 px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-red-50 transition">Reject</button>
                                </form>
                            
                            @elseif(in_array($item->status, ['Approved', 'Taping', 'Editing']))
                                <form action="{{ route('admin.workflow.update', $item->id) }}" method="POST" class="inline">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="action" value="advance">
                                    <button class="bg-[#00588a] text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-[#00466e] shadow-sm transition flex items-center gap-1">
                                        Lanjut Proses <i class="fa-solid fa-arrow-right"></i>
                                    </button>
                                </form>
                            
                            @elseif($item->status == 'Ready')
                                <div x-data="{ open: false }" class="inline-block relative">
                                    <button @click="open = true" class="bg-green-600 text-white px-3 py-1.5 rounded-lg text-xs font-bold hover:bg-green-700 shadow-sm transition flex items-center gap-1">
                                        <i class="fa-solid fa-upload"></i> Publish
                                    </button>
                                    
                                    <!-- Modal Publish -->
                                    <div x-show="open" @click.outside="open = false" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4" x-cloak>
                                        <div class="bg-white p-6 rounded-xl shadow-2xl w-full max-w-md text-left">
                                            <h3 class="font-bold text-lg mb-4 text-gray-800">Publish Video Final</h3>
                                            <form action="{{ route('admin.workflow.publish', $item->id) }}" method="POST">
                                                @csrf
                                                <div class="mb-3">
                                                    <label class="block text-xs font-bold text-gray-500 mb-1">Judul Final</label>
                                                    <input type="text" name="judul_final" value="{{ $item->matkul->nama_mk }} - {{ $item->topik }}" class="w-full border p-2 rounded text-sm focus:ring-2 focus:ring-green-500" required>
                                                </div>
                                                <div class="mb-5">
                                                    <label class="block text-xs font-bold text-gray-500 mb-1">Link Video (YouTube/Drive)</label>
                                                    <input type="url" name="link_video" placeholder="https://..." class="w-full border p-2 rounded text-sm focus:ring-2 focus:ring-green-500" required>
                                                </div>
                                                <div class="flex justify-end gap-3">
                                                    <button type="button" @click="open=false" class="text-sm text-gray-500 hover:text-gray-700 font-medium">Batal</button>
                                                    <button class="bg-green-600 text-white px-5 py-2 rounded text-sm font-bold hover:bg-green-700">Simpan & Publish</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-gray-500 italic">
                            <i class="fa-solid fa-folder-open text-2xl mb-2 text-gray-300 block"></i>
                            Belum ada data antrian.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection