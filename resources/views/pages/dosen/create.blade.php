@extends('layouts.app')
@section('title', 'Form Pengajuan Taping')
@section('header_title', 'Form Pengajuan Jadwal')
@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm border border-gray-200 p-8">
    <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
        @csrf
        <div
            x-data="{
                search: '',
                open: false,
                selectedId: '',
                items: {{ Js::from($matkuls->map(fn($m) => ['id' => $m->id, 'name' => $m->nama_mk])) }}
            }"
            class="relative"
        >
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Mata Kuliah
                <span class="text-red-500">*</span>
            </label>
            <input type="hidden" name="matkul_id" x-model="selectedId" required>
            <input
                type="text"
                x-model="search"
                @input="open = true"
                @click.outside="open = false"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#00588a] outline-none transition"
                placeholder="Cari mata kuliah..."
                autocomplete="off"
                required
            >
            <div
                x-show="open && search.length >= 1"
                class="absolute z-10 w-full bg-white border border-gray-200 rounded-lg shadow-lg mt-1 max-h-48 overflow-y-auto"
                x-transition
            >
                <template
                    x-for="item in items.filter(i => i.name.toLowerCase().includes(search.toLowerCase()))"
                    :key="item.id"
                >
                    <div
                        @click="selectedId = item.id; search = item.name; open = false"
                        class="px-4 py-3 cursor-pointer text-sm text-gray-700 border-b border-gray-50 last:border-0 hover:bg-blue-50 transition"
                    >
                        <span x-text="item.name"></span>
                    </div>
                </template>
                <div
                    x-show="items.filter(i => i.name.toLowerCase().includes(search.toLowerCase())).length === 0"
                    class="px-4 py-3 text-sm text-gray-500 italic bg-gray-50"
                >
                    Mata kuliah tidak ditemukan.
                </div>
            </div>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Topik / Judul Video
                <span class="text-red-500">*</span>
            </label>
            <input
                type="text"
                name="topik"
                value="{{ old('topik') }}"
                class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#00588a] outline-none"
                placeholder="Contoh: Pengenalan Struktur Data"
                required
            >
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Rencana Tanggal
                    <span class="text-red-500">*</span>
                </label>
                <input
                    type="date"
                    name="tanggal_taping"
                    value="{{ old('tanggal_taping') }}"
                    class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#00588a] outline-none"
                    required
                >
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Sesi Waktu
                    <span class="text-red-500">*</span>
                </label>
                <div class="relative">
                    <select
                        name="sesi"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-[#00588a] outline-none appearance-none bg-white"
                        required
                    >
                        <option value="">Pilih Sesi...</option>
                        <option value="09:00 - 11:00">09:00 - 11:00</option>
                        <option value="13:00 - 15:00">13:00 - 15:00</option>
                        <option value="16:00 - 18:00">16:00 - 18:00</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-3 pointer-events-none">
                        <i class="fa-solid fa-chevron-down text-gray-500 text-xs"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="flex justify-end pt-6 border-t border-gray-100">
            <a
                href="{{ route('dashboard') }}"
                class="px-5 py-2 rounded-lg text-gray-700 font-medium hover:bg-gray-100 transition mr-3"
            >
                Batal
            </a>
            <button
                type="submit"
                class="bg-[#00588a] text-white px-6 py-2.5 rounded-lg font-bold text-sm hover:bg-[#00466e] shadow-lg shadow-[#00588a]/30 transition transform active:scale-95"
            >
                Kirim Pengajuan
            </button>
        </div>
    </form>
</div>
@endsection
