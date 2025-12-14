@extends('layouts.app')
@section('title', 'Admin Dashboard')
@section('header_title', 'Dashboard Overview')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex justify-between items-center cursor-pointer hover:border-yellow-400 transition" onclick="window.location='{{ route('admin.queue') }}'">
        <div>
            <p class="text-xs font-medium text-gray-500 uppercase">Permintaan Baru</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['pending'] }}</h3>
        </div>
        <div class="w-10 h-10 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center">
            <i class="fa-solid fa-inbox"></i>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex justify-between items-center">
        <div>
            <p class="text-xs font-medium text-gray-500 uppercase">Taping Hari Ini</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['taping_today'] }}</h3>
        </div>
        <div class="w-10 h-10 bg-blue-100 text-theme rounded-full flex items-center justify-center">
            <i class="fa-solid fa-video"></i>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex justify-between items-center">
        <div>
            <p class="text-xs font-medium text-gray-500 uppercase">Sedang Diedit</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['editing'] }}</h3>
        </div>
        <div class="w-10 h-10 bg-orange-100 text-orange-600 rounded-full flex items-center justify-center">
            <i class="fa-solid fa-wand-magic-sparkles"></i>
        </div>
    </div>
    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 flex justify-between items-center cursor-pointer hover:border-green-400 transition" onclick="window.location='{{ route('library.index') }}'">
        <div>
            <p class="text-xs font-medium text-gray-500 uppercase">Total Video</p>
            <h3 class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['total_video'] }}</h3>
        </div>
        <div class="w-10 h-10 bg-green-100 text-green-600 rounded-full flex items-center justify-center">
            <i class="fa-brands fa-youtube"></i>
        </div>
    </div>
</div>
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
    <div class="lg:col-span-8 bg-white rounded-xl shadow-sm border border-gray-100 p-6 overflow-hidden">
        <div class="flex justify-between items-center mb-6">
            <h3 class="font-bold text-gray-800">Antrian Terbaru</h3>
            <a href="{{ route('admin.queue') }}" class="text-xs text-theme hover:underline font-medium">Lihat Semua →</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead class="bg-gray-50 border-b border-gray-200 text-xs text-gray-500 uppercase font-bold">
                    <tr>
                        <th class="py-3 px-4">Waktu</th>
                        <th class="py-3 px-4">Project</th>
                        <th class="py-3 px-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($bookings->take(5) as $item)
                        <tr class="hover:bg-gray-50 transition">
                            <td class="py-3 px-4">
                                <div class="text-xs font-bold text-gray-700">{{ \Carbon\Carbon::parse($item->tanggal_taping)->format('d M') }}</div>
                                <div class="text-[10px] text-gray-500">{{ $item->sesi }}</div>
                            </td>
                            <td class="py-3 px-4">
                                <div class="text-sm font-bold text-gray-800">{{ $item->matkul->nama_mk }}</div>
                                <div class="text-xs text-gray-500">{{ $item->user->nama }}</div>
                            </td>
                            <td class="py-3 px-4 text-center">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase border {{ $item->status_badge_atribut }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                    @if($bookings->count() === 0)
                        <tr>
                            <td colspan="3" class="py-6 text-center text-gray-400 text-xs italic">
                                Belum ada pengajuan booking.
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <div class="lg:col-span-4 space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 text-sm mb-4">Aktivitas Terakhir</h3>
            <div class="space-y-4">
                <div class="flex gap-3 items-start">
                    <div class="mt-0.5 text-green-500">
                        <i class="fa-solid fa-circle-check text-xs"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-800">Publish Video</p>
                        <p class="text-[10px] text-gray-500">Contoh aktivitas publish video ke library.</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">10 menit lalu</p>
                    </div>
                </div>
                <div class="flex gap-3 items-start">
                    <div class="mt-0.5 text-blue-500">
                        <i class="fa-solid fa-envelope-open text-xs"></i>
                    </div>
                    <div>
                        <p class="text-xs font-bold text-gray-800">Request Baru</p>
                        <p class="text-[10px] text-gray-500">Dosen mengajukan jadwal taping baru.</p>
                        <p class="text-[10px] text-gray-400 mt-0.5">1 jam lalu</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
