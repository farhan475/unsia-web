@extends('layouts.app')
@section('title', 'Dashboard Dosen')
@section('header_title', 'Dashboard Dosen')
@section('content')
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Video Saya</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['video_saya'] }}</p>
        </div>
        <div class="w-10 h-10 bg-blue-50 text-theme rounded-full flex items-center justify-center">
            <i class="fa-brands fa-youtube text-lg"></i>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Menunggu Acc</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['pending'] }}</p>
        </div>
        <div class="w-10 h-10 bg-yellow-50 text-yellow-600 rounded-full flex items-center justify-center">
            <i class="fa-solid fa-hourglass-half text-lg"></i>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex items-center justify-between">
        <div>
            <p class="text-xs font-medium text-gray-500 uppercase tracking-wide">Jadwal Disetujui</p>
            <p class="text-2xl font-bold text-gray-800 mt-1">{{ $stats['approved'] }}</p>
        </div>
        <div class="w-10 h-10 bg-green-50 text-green-600 rounded-full flex items-center justify-center">
            <i class="fa-regular fa-calendar-check text-lg"></i>
        </div>
    </div>
    <a
        href="{{ route('bookings.create') }}"
        class="bg-white rounded-xl shadow-sm p-5 border border-gray-100 flex items-center gap-4 hover:border-theme transition cursor-pointer group"
    >
        <div class="w-10 h-10 bg-theme text-white rounded-full flex items-center justify-center group-hover:scale-110 transition-transform">
            <i class="fa-solid fa-plus"></i>
        </div>
        <div>
            <p class="text-sm font-bold text-gray-700 leading-tight">
                Ajukan
                <br>
                Jadwal Baru
            </p>
        </div>
    </a>
</div>
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="font-bold text-gray-800">Kalender Studio</h3>
                <div class="flex gap-3 mt-1 text-[10px] text-gray-500">
                    <span class="flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-theme"></span>
                        Jadwal Anda
                    </span>
                    <span class="flex items-center gap-1">
                        <span class="w-2 h-2 rounded-full bg-gray-300"></span>
                        Penuh
                    </span>
                </div>
            </div>
            <span class="text-xs font-bold text-gray-600">
                {{ now()->format('F Y') }}
            </span>
        </div>
        <div class="grid grid-cols-7 gap-2 mb-2 text-center text-[10px] font-bold text-gray-400 uppercase">
            <div>Sen</div>
            <div>Sel</div>
            <div>Rab</div>
            <div>Kam</div>
            <div>Jum</div>
            <div class="text-red-400">Sab</div>
            <div class="text-red-400">Min</div>
        </div>
        <div class="grid grid-cols-7 gap-2">
            @for($i = 1; $i <= now()->daysInMonth; $i++)
                @php
                    $date = now()->setDay($i)->format('Y-m-d');
                    $dayBookings = $calendarData[$date] ?? collect();
                    $isMySchedule = $dayBookings->where('user_id', Auth::id())->count() > 0;
                    $isBusy = $dayBookings->count() >= 3;
                    $isToday = $date === now()->format('Y-m-d');
                @endphp
                <div class="h-20 p-1 border rounded-lg flex flex-col relative transition hover:shadow-sm {{ $isToday ? 'bg-blue-50 border-theme' : 'bg-white border-gray-100' }}">
                    <span class="text-[10px] font-bold w-5 h-5 flex items-center justify-center rounded-full {{ $isToday ? 'bg-theme text-white' : 'text-gray-700' }}">
                        {{ $i }}
                    </span>
                    <div class="mt-1 flex flex-col gap-0.5">
                        @if($isMySchedule)
                            <div class="w-full bg-theme text-white text-[8px] px-1 py-0.5 rounded truncate font-medium">
                                🎥 Saya
                            </div>
                        @elseif($isBusy)
                            <div class="w-full bg-gray-200 text-gray-600 text-[8px] px-1 py-0.5 rounded truncate font-medium">
                                🔒 Penuh
                            </div>
                        @endif
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 text-sm mb-4">Jadwal Anda Berikutnya</h3>
            @if($nextSchedule)
                <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                    <div class="flex justify-between items-start mb-2">
                        <span class="bg-white text-theme border border-blue-200 text-[10px] font-bold px-2 py-0.5 rounded">
                            {{ $nextSchedule->status }}
                        </span>
                        <i class="fa-solid fa-video text-theme opacity-50"></i>
                    </div>
                    <h4 class="font-bold text-gray-800 text-sm mb-1 line-clamp-2">
                        {{ $nextSchedule->matkul->nama_mk }}
                    </h4>
                    <p class="text-xs text-gray-500 mb-3">
                        {{ $nextSchedule->topik }}
                    </p>
                    <div class="space-y-1.5 text-[11px] text-gray-600 font-medium">
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-calendar w-3.5"></i>
                            {{ \Carbon\Carbon::parse($nextSchedule->tanggal_taping)->format('d M Y') }}
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-regular fa-clock w-3.5"></i>
                            {{ $nextSchedule->sesi }}
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="fa-solid fa-location-dot w-3.5"></i>
                            {{ $nextSchedule->studio->nama ?? 'Studio Multimedia' }}
                        </div>
                    </div>
                </div>
            @else
                <div class="text-center py-6 text-gray-400 italic text-xs">
                    Belum ada jadwal yang disetujui.
                </div>
            @endif
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <h3 class="font-bold text-gray-800 text-sm mb-3">Pengumuman</h3>
            <div class="p-3 bg-yellow-50 rounded border border-yellow-100 flex gap-3">
                <i class="fa-solid fa-triangle-exclamation text-yellow-600 mt-0.5 text-xs"></i>
                <div>
                    <span class="font-bold text-yellow-800 text-xs block">
                        Maintenance Alat
                    </span>
                    <p class="text-[10px] text-yellow-700 mt-0.5">
                        Tanggal 5 setiap bulan studio libur untuk perawatan berkala.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection