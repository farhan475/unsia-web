<header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 z-20 shadow-sm">
    <!-- Judul Halaman -->
    <h2 class="text-xl font-bold text-gray-800 tracking-tight">@yield('title')</h2>
    
    <!-- Informasi & Aksi -->
    <div class="flex items-center gap-4">
        <!-- Semester Info -->
        <div class="hidden md:flex items-center gap-2 px-3 py-1 bg-blue-50 rounded-full border border-blue-100">
            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
            <span class="text-xs font-medium text-blue-800">Semester Ganjil 2023/2024</span>
        </div>
        
        <div class="h-8 w-px bg-gray-200 hidden md:block"></div>
        
        <!-- Notifications -->
        <button class="relative p-2 text-gray-400 hover:text-gray-600 transition">
            <i class="fa-regular fa-bell text-lg"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
        </button>
        
        <!-- Button Aksi (Ajukan Baru / Sesuai Halaman) -->
        @if(Request::is('bookings/create'))
            <!-- Dosen: Tombol Ajukan Baru -->
            <!-- Tidak ditampilkan karena form sudah ada di page -->
        @elseif(Auth::user()->role == 'admin' && Request::is('admin/queue'))
            <!-- Admin: Tidak ada tombol spesifik di navbar -->
        @endif
        
        @if(Auth::user()->role == 'dosen' && Request::is('bookings'))
            <a href="{{ route('bookings.create') }}" class="bg-theme hover:bg-[#00466e] text-white px-4 py-2 rounded-lg text-sm font-medium shadow-sm transition-colors flex items-center gap-2">
                <i class="fa-solid fa-plus"></i> Ajukan Baru
            </a>
        @endif
    </div>
</header>