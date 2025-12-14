@extends('components.layout')
@section('title', 'Dashboard Dosen')
@section('header_title', 'Dashboard Dosen')

@section('content')
    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Card 1: Video Saya -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center justify-between">
            <div><p class="text-sm font-medium text-gray-500">Video Saya</p><p class="text-3xl font-bold text-gray-800">{{ $stats['total_videos'] }}</p></div>
            <div class="w-12 h-12 bg-blue-50 text-[#00588a] rounded-lg flex items-center justify-center text-xl"><i class="fa-brands fa-youtube"></i></div>
        </div>
        <!-- Card 2: Menunggu Approval -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center justify-between">
            <div><p class="text-sm font-medium text-gray-500">Menunggu Acc</p><p class="text-3xl font-bold text-gray-800">{{ $stats['pending'] }}</p></div>
            <div class="w-12 h-12 bg-yellow-50 text-yellow-600 rounded-lg flex items-center justify-center text-xl"><i class="fa-solid fa-hourglass-half"></i></div>
        </div>
        <!-- Card 3: Jadwal Disetujui -->
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center justify-between">
            <div><p class="text-sm font-medium text-gray-500">Jadwal Disetujui</p><p class="text-3xl font-bold text-gray-800">{{ $stats['approved'] }}</p></div>
            <div class="w-12 h-12 bg-green-50 text-green-600 rounded-lg flex items-center justify-center text-xl"><i class="fa-regular fa-calendar-check"></i></div>
        </div>
        <!-- Card 4: Ajukan Jadwal Baru -->
        <a href="{{ route('bookings.create') }}" class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center gap-4 hover:border-[#00588a] transition cursor-pointer group">
            <div class="w-10 h-10 bg-[#00588a] text-white rounded-full flex items-center justify-center text-lg group-hover:scale-110 transition-transform"><i class="fa-solid fa-plus"></i></div>
            <div>
                <p class="text-sm font-bold text-gray-700 leading-tight">Ajukan<br>Jadwal Baru</p>
            </div>
        </a>
    </div>

    <!-- MAIN CONTENT GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- LEFT: Calendar Section -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h3 class="font-bold text-gray-800 text-base">Kalender Ketersediaan Studio</h3>
                    <div class="flex items-center gap-3 mt-1">
                        <span class="flex items-center text-[10px] text-gray-500 gap-1"><span class="w-2 h-2 rounded-full bg-[#00588a]"></span> Jadwal Anda</span>
                        <span class="flex items-center text-[10px] text-gray-500 gap-1"><span class="w-2 h-2 rounded-full bg-gray-300"></span> Studio Sibuk</span>
                    </div>
                </div>
                <span class="text-xs font-bold text-gray-700">November 2023</span>
            </div>
            <!-- Calendar Grid Header -->
            <div class="grid grid-cols-7 gap-2 mb-2 text-center text-[10px] font-bold text-gray-400 uppercase tracking-wide">
                <div>Sen</div><div>Sel</div><div>Rab</div><div>Kam</div><div>Jum</div><div class="text-red-400">Sab</div><div class="text-red-400">Min</div>
            </div>
            <!-- Calendar Grid Body (Mockup Visual) -->
            <div class="grid grid-cols-7 gap-2">
                <!-- Placeholder untuk hari sebelum tanggal 1 -->
                @for($i = 0; $i < 2; $i++) <div class="h-24 bg-gray-50/30 rounded border"></div> @endfor
                
                <!-- Hari di Bulan November -->
                @for($day = 1; $day <= 30; $day++)
                    @php
                        $isToday = ($day == now()->day && now()->month == 11 && now()->year == 2023);
                        $hasMySchedule = ($day == 28); // Mock data Anda punya jadwal tgl 28
                        $isBusy = in_array($day, [29, 30]); // Mock data studio penuh tgl 29 & 30
                    @endphp
                    <div class="h-24 p-1 rounded-lg border flex flex-col justify-between relative {{ $isToday ? 'bg-blue-50/30 border-blue-200' : 'bg-white border-gray-100' }} transition hover:shadow-sm">
                        <div class="flex justify-between items-start">
                            <span class="text-xs font-bold w-6 h-6 flex items-center justify-center rounded-full {{ $isToday ? 'bg-[#00588a] text-white' : 'text-gray-700' }}">{{ $day }}</span>
                        </div>
                        <div class="mt-1 flex flex-col gap-0.5">
                            @if($hasMySchedule)
                                <div class="w-full bg-[#00588a] text-white text-[8px] px-1.5 py-0.5 rounded truncate font-medium">
                                    <i class="fa-solid fa-video mr-0.5"></i> Jadwal Saya (09:00)
                                </div>
                            @endif
                            @if($isBusy)
                                <div class="w-full bg-gray-200 text-gray-600 text-[8px] px-1.5 py-0.5 rounded truncate font-medium">
                                    <i class="fa-solid fa-lock mr-0.5"></i> Studio Penuh (1)
                                </div>
                            @endif
                        </div>
                    </div>
                @endfor
            </div>
        </div>

        <!-- RIGHT SIDEBAR WIDGETS -->
        <div class="space-y-6">
            <!-- Jadwal Berikutnya -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-800 text-sm mb-4">Jadwal Anda Berikutnya</h3>
                @if($nextSchedule)
                    <div class="bg-blue-50 border border-blue-100 rounded-lg p-4">
                        <div class="flex justify-between items-start mb-2">
                            <span class="bg-white text-[#00588a] border border-blue-200 text-[10px] font-bold px-2 py-1 rounded">{{ $nextSchedule->status }}</span>
                            <i class="fa-solid fa-video text-[#00588a] opacity-50"></i>
                        </div>
                        <h4 class="font-bold text-gray-800 text-sm mb-3">{{ $nextSchedule->matkul->nama_mk }}</h4>
                        <div class="space-y-2 text-xs text-gray-600">
                            <div class="flex items-center gap-2"><i class="fa-regular fa-calendar w-4"></i> {{ $nextSchedule->tanggal_taping->format('Y-m-d') }}</div>
                            <div class="flex items-center gap-2"><i class="fa-regular fa-clock w-4"></i> {{ $nextSchedule->sesi }}</div>
                            <div class="flex items-center gap-2"><i class="fa-solid fa-location-dot w-4"></i> {{ $nextSchedule->studio->nama }}</div>
                        </div>
                    </div>
                @else
                    <p class="text-sm text-gray-500 italic text-center">Belum ada jadwal yang disetujui.</p>
                @endif
            </div>

            <!-- Pengumuman -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                <h3 class="font-bold text-gray-800 text-sm mb-4">Pengumuman</h3>
                <div class="p-3 bg-yellow-50 rounded border border-yellow-100">
                    <div class="flex items-center gap-2 mb-1">
                        <i class="fa-solid fa-triangle-exclamation text-yellow-600 text-xs"></i>
                        <span class="font-bold text-yellow-800 text-xs">Maintenance Alat</span>
                    </div>
                    <p class="text-[11px] text-gray-600 leading-relaxed">
                        Tanggal 5 Des Studio libur untuk perawatan.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection