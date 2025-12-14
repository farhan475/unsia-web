<header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-4 md:px-8 z-20 shadow-sm">
    <h2 class="text-lg md:text-xl font-bold text-gray-800 tracking-tight">
        @yield('header_title', 'Dashboard')
    </h2>

    <div class="flex items-center gap-3 md:gap-4">
        <div class="hidden md:flex items-center gap-2 px-3 py-1 bg-blue-50 rounded-full border border-blue-100">
            <span class="relative flex h-2 w-2">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-2 w-2 bg-green-500"></span>
            </span>
            <span class="text-[11px] font-semibold text-blue-800">
                Semester Ganjil 2023/2024
            </span>
        </div>

        <div class="h-6 w-px bg-gray-200 hidden md:block"></div>

        <button class="relative p-2 text-gray-400 hover:text-gray-600 transition">
            <i class="fa-regular fa-bell text-lg"></i>
            <span class="absolute top-1.5 right-1.5 w-2 h-2 bg-red-500 rounded-full border border-white"></span>
        </button>

        @if(Auth::user()->role === 'dosen' && !request()->routeIs('bookings.create'))
            <a href="{{ route('bookings.create') }}"
            class="hidden md:inline-flex bg-theme hover:bg-theme-dark text-white px-4 py-2 rounded-lg text-xs font-bold shadow-sm transition-colors items-center gap-2">
                <i class="fa-solid fa-plus"></i>
                Ajukan Baru
            </a>
        @endif
    </div>
</header>
