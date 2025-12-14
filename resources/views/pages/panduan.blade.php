@extends('components.layout')
@section('title', 'Panduan Produksi')

@section('content')
<div class="max-w-5xl mx-auto">
    <!-- Hero Header -->
    <div class="bg-gradient-to-r from-[#00588a] to-[#003b5c] rounded-2xl p-10 text-white mb-10 shadow-lg relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-3xl font-bold mb-2">Panduan Taping Video Pembelajaran</h2>
            <p class="text-blue-100 text-lg max-w-2xl">Standar Operasional Prosedur (SOP) untuk Dosen Universitas Siber Asia dalam memproduksi konten digital.</p>
        </div>
        <i class="fa-solid fa-clapperboard absolute -right-6 -bottom-10 text-9xl text-white/10 rotate-12"></i>
    </div>

    <!-- Steps Process -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        @php
            $steps = [
                ['icon' => 'fa-calendar-plus', 'title' => '1. Ajukan Jadwal', 'desc' => 'Login dan pilih menu Jadwal. Isi form mata kuliah dan pilih sesi kosong.'],
                ['icon' => 'fa-video', 'title' => '2. Proses Taping', 'desc' => 'Datang ke studio sesuai jadwal yang telah disetujui (Approved).'],
                ['icon' => 'fa-wand-magic-sparkles', 'title' => '3. Editing', 'desc' => 'Tim Multimedia melakukan editing. Status berubah menjadi Editing.'],
                ['icon' => 'fa-upload', 'title' => '4. Publish', 'desc' => 'Video final diupload ke Library dan siap digunakan di LMS.']
            ];
        @endphp

        @foreach($steps as $step)
        <div class="bg-white p-6 rounded-xl border border-gray-200 shadow-sm hover:shadow-md hover:-translate-y-1 transition duration-300">
            <div class="w-12 h-12 bg-blue-50 text-[#00588a] rounded-lg flex items-center justify-center text-xl mb-4">
                <i class="fa-solid {{ $step['icon'] }}"></i>
            </div>
            <h3 class="font-bold text-gray-800 text-lg mb-2">{{ $step['title'] }}</h3>
            <p class="text-sm text-gray-500 leading-relaxed">{{ $step['desc'] }}</p>
        </div>
        @endforeach
    </div>

    <!-- FAQ -->
    <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-8">
        <h3 class="font-bold text-xl text-gray-800 mb-6 flex items-center gap-2">
            <i class="fa-solid fa-circle-question text-[#00588a]"></i> Pertanyaan Umum (FAQ)
        </h3>
        
        <div class="space-y-4">
            <details class="group bg-gray-50 p-4 rounded-lg cursor-pointer transition open:bg-blue-50">
                <summary class="flex justify-between items-center font-bold text-gray-700 list-none">
                    <span>Berapa lama durasi maksimal satu sesi rekaman?</span>
                    <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-sm"></i></span>
                </summary>
                <p class="text-gray-600 text-sm mt-3 pl-4 border-l-2 border-[#00588a]">Satu sesi booking standar adalah 120 menit (2 jam). Ini sudah termasuk persiapan alat, briefing singkat, dan rekaman materi. Mohon datang tepat waktu.</p>
            </details>

            <details class="group bg-gray-50 p-4 rounded-lg cursor-pointer transition open:bg-blue-50">
                <summary class="flex justify-between items-center font-bold text-gray-700 list-none">
                    <span>Apa yang harus saya persiapkan sebelum datang?</span>
                    <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-sm"></i></span>
                </summary>
                <p class="text-gray-600 text-sm mt-3 pl-4 border-l-2 border-[#00588a]">
                    1. File Materi (PPT) dengan rasio 16:9.<br>
                    2. Naskah atau poin-poin materi.<br>
                    3. Berpakaian rapi (Formal). Hindari warna hijau jika menggunakan studio Green Screen.
                </p>
            </details>
            
            <details class="group bg-gray-50 p-4 rounded-lg cursor-pointer transition open:bg-blue-50">
                <summary class="flex justify-between items-center font-bold text-gray-700 list-none">
                    <span>Bagaimana jika saya ingin membatalkan jadwal?</span>
                    <span class="transition group-open:rotate-180"><i class="fa-solid fa-chevron-down text-sm"></i></span>
                </summary>
                <p class="text-gray-600 text-sm mt-3 pl-4 border-l-2 border-[#00588a]">Jika status masih 'Pending', Anda tidak perlu melakukan apa-apa. Jika sudah 'Approved', harap hubungi Admin Multimedia via WhatsApp minimal H-1.</p>
            </details>
        </div>
    </div>
</div>
@endsection