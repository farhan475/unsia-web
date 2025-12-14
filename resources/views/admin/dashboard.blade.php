@extends('layouts.app')
@section('title', 'Admin Panel')
@section('header_title', 'Antrian Produksi')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
    <div class="p-5 border-b border-gray-200 bg-gray-50 flex justify-between items-center">
        <h3 class="font-bold text-gray-800">Daftar Antrian Produksi</h3>
    </div>
    
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 border-b border-gray-200 text-xs text-gray-500 uppercase">
                <tr>
                    <th class="px-6 py-3 font-medium">Jadwal</th>
                    <th class="px-6 py-3 font-medium">Mata Kuliah & Dosen</th>
                    <th class="px-6 py-3 font-medium">Studio</th>
                    <th class="px-6 py-3 font-medium text-center">Status</th>
                    <th class="px-6 py-3 font-medium text-right">Aksi Admin</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($bookings as $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4">
                            <div class="font-bold text-sm text-gray-800">{{ $item->tanggal_taping->format('d M Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $item->sesi }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-[10px] font-bold border rounded px-1 prodi-{{ $item->user->prodi->kode ?? 'IF' }}">
                                    {{ $item->user->prodi->kode ?? 'UMUM' }}
                                </span>
                                <span class="font-bold text-sm text-gray-800">{{ $item->matkul->nama_mk }}</span>
                            </div>
                            <p class="text-xs text-gray-600">{{ $item->user->name }}</p>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $item->studio->nama }}</td>
                        <td class="px-6 py-4 text-center">
                            <!-- Menggunakan Accessor Warna dari Model -->
                            <span class="px-2 py-1 rounded-full text-[10px] font-bold uppercase border {{ $item->status_badge }}">
                                {{ $item->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <form action="{{ route('admin.status.update', $item->id) }}" method="POST" class="inline">
                                @csrf @method('PATCH')
                                @if($item->status == 'Pending')
                                    <button name="status" value="Approved" class="text-xs bg-blue-600 text-white px-2 py-1 rounded hover:bg-blue-700">Approve</button>
                                    <button name="status" value="Rejected" class="text-xs bg-red-100 text-red-600 px-2 py-1 rounded hover:bg-red-200 ml-1">Reject</button>
                                @elseif($item->status == 'Approved')
                                    <button name="status" value="Taping" class="text-xs bg-purple-600 text-white px-2 py-1 rounded">Mulai Taping</button>
                                @elseif($item->status == 'Taping')
                                    <button name="status" value="Editing" class="text-xs bg-orange-500 text-white px-2 py-1 rounded">Selesai Taping</button>
                                @elseif($item->status == 'Editing')
                                    <button name="status" value="Published" class="text-xs bg-green-600 text-white px-2 py-1 rounded">Publish</button>
                                @endif
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="5" class="p-4 text-center text-gray-500">Belum ada data.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection