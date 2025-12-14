@extends('layouts.app')
@section('title', 'Video Library')
@section('header_title', 'Video Library')
@section('content')
<div class="flex flex-wrap gap-4 mb-8 items-center">
    <form method="GET" action="{{ route('library.index') }}" class="flex gap-4 flex-wrap">
        <select
            name="tahun_akademik"
            class="border border-gray-300 rounded-lg px-4 py-2 text-sm bg-white focus:ring-2 focus:ring-[#00588a] outline-none"
        >
            <option value="">Semua Tahun Ajaran</option>
            <option value="2023/2024" @selected(request('tahun_akademik') === '2023/2024')>2023/2024</option>
            <option value="2022/2023" @selected(request('tahun_akademik') === '2022/2023')>2022/2023</option>
        </select>
        <select
            name="semester"
            class="border border-gray-300 rounded-lg px-4 py-2 text-sm bg-white focus:ring-2 focus:ring-[#00588a] outline-none"
        >
            <option value="">Semua Semester</option>
            <option value="Ganjil" @selected(request('semester') === 'Ganjil')>Ganjil</option>
            <option value="Genap" @selected(request('semester') === 'Genap')>Genap</option>
        </select>
        <select
            name="prodi_id"
            class="border border-gray-300 rounded-lg px-4 py-2 text-sm bg-white focus:ring-2 focus:ring-[#00588a] outline-none"
        >
            <option value="">Semua Prodi</option>
            @foreach($prodis as $prodi)
                <option value="{{ $prodi->id }}" @selected(request('prodi_id') == $prodi->id)>
                    {{ $prodi->nama }}
                </option>
            @endforeach
        </select>
        <button
            type="submit"
            class="bg-[#00588a] text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-[#00466e]"
        >
            Filter
        </button>
    </form>
</div>
<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($videos as $video)
        <div class="bg-white border border-gray-200 rounded-xl shadow-sm hover:shadow-lg transition-all duration-300 group overflow-hidden flex flex-col">
            <div class="h-40 bg-gray-800 relative flex items-center justify-center group-hover:bg-gray-700 transition">
                <i class="fa-solid fa-play text-4xl text-white/50 group-hover:text-white group-hover:scale-110 transition-transform duration-300"></i>
                <span class="absolute top-2 right-2 bg-black/60 text-white text-[10px] px-2 py-1 rounded backdrop-blur-sm">
                    {{ $video->booking->user->prodi->kode ?? 'UNSIA' }}
                </span>
            </div>
            <div class="p-4 flex-1 flex flex-col">
                <h4 class="font-bold text-gray-800 text-sm line-clamp-2 mb-1" title="{{ $video->judul }}">
                    {{ $video->judul }}
                </h4>
                <p class="text-xs text-gray-500 mb-4">
                    {{ $video->booking->user->nama }}
                </p>
                <div class="mt-auto border-t border-gray-100 pt-3 flex justify-between items-center">
                    <span class="text-[10px] text-gray-400 bg-gray-100 px-2 py-0.5 rounded">
                        {{ $video->semester }}
                    </span>
                    <a
                        href="{{ $video->link_video }}"
                        target="_blank"
                        class="text-xs font-bold text-[#00588a] hover:underline flex items-center gap-1"
                    >
                        Tonton
                        <i class="fa-solid fa-arrow-up-right-from-square text-[10px]"></i>
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-span-full flex flex-col items-center justify-center py-12 text-gray-400">
            <i class="fa-solid fa-film text-4xl mb-3"></i>
            <p>Belum ada video yang dipublish.</p>
        </div>
    @endforelse
</div>
<div class="mt-8">
    {{ $videos->links() }}
</div>
@endsection