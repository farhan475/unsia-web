@php
    $role = Auth::user()->role ?? 'dosen';
@endphp

<aside class="w-64 bg-theme border-r border-theme-dark hidden md:flex flex-col z-10 text-white shadow-xl">
    <div class="h-16 flex items-center px-6 border-b border-theme-dark">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-theme font-bold text-lg shadow-sm">
                {{ $role === 'admin' ? 'A' : 'U' }}
            </div>
            <span class="font-bold text-lg tracking-tight">
                {{ $role === 'admin' ? 'Admin Studio' : 'Portal Dosen' }}
            </span>
        </div>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
        <p class="px-2 text-[10px] font-bold text-blue-200 uppercase tracking-wider mb-2">
            Menu Utama
        </p>

        <a href="{{ route('dashboard') }}"
        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all
        {{ request()->routeIs('dashboard') || request()->routeIs('admin.dashboard') ? 'bg-theme-dark shadow-inner text-white' : 'text-blue-100 hover:bg-theme-dark hover:text-white' }}">
            <i class="fa-solid fa-chart-line w-6 text-center mr-2"></i>
            Dashboard
        </a>

        @if($role === 'dosen')
            <a href="{{ route('bookings.create') }}"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all
            {{ request()->routeIs('bookings.create') ? 'bg-theme-dark shadow-inner text-white' : 'text-blue-100 hover:bg-theme-dark hover:text-white' }}">
                <i class="fa-regular fa-calendar-plus w-6 text-center mr-2"></i>
                Ajukan Jadwal
            </a>
        @endif

        @if($role === 'admin')
            <a href="{{ route('admin.queue') }}"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all
            {{ request()->routeIs('admin.queue') ? 'bg-theme-dark shadow-inner text-white' : 'text-blue-100 hover:bg-theme-dark hover:text-white' }}">
                <i class="fa-solid fa-list-check w-6 text-center mr-2"></i>
                Antrian Produksi
                @php
                    $pendingCount = \App\Models\Booking::where('status', 'Pending')->count();
                @endphp
                @if($pendingCount > 0)
                    <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">
                        {{ $pendingCount }}
                    </span>
                @endif
            </a>

            <p class="px-2 text-[10px] font-bold text-blue-200 uppercase tracking-wider mt-6 mb-2">
                Data Master
            </p>

            <a href="{{ route('admin.dosen.index') }}"
            class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all
            {{ request()->routeIs('admin.dosen.*') ? 'bg-theme-dark shadow-inner text-white' : 'text-blue-100 hover:bg-theme-dark hover:text-white' }}">
                <i class="fa-solid fa-users-gear w-6 text-center mr-2"></i>
                Data Dosen
            </a>
        @endif

        <p class="px-2 text-[10px] font-bold text-blue-200 uppercase tracking-wider mt-6 mb-2">
            Arsip & Bantuan
        </p>

        <a href="{{ route('library.index') }}"
        class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all
        {{ request()->routeIs('library.index') ? 'bg-theme-dark shadow-inner text-white' : 'text-blue-100 hover:bg-theme-dark hover:text-white' }}">
            <i class="fa-brands fa-youtube w-6 text-center mr-2"></i>
            Video Library
        </a>

        <a href="{{ route('panduan') }}"
           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-all
           {{ request()->routeIs('panduan') ? 'bg-theme-dark shadow-inner text-white' : 'text-blue-100 hover:bg-theme-dark hover:text-white' }}">
            <i class="fa-solid fa-book-open w-6 text-center mr-2"></i>
            Panduan
        </a>
    </nav>

    <div class="border-t border-theme-dark p-4 bg-theme-dark/20">
        <div class="flex items-center gap-3">
            <div class="w-9 h-9 rounded-full bg-white text-theme flex items-center justify-center font-bold text-sm border-2 border-blue-300">
                {{ strtoupper(substr(Auth::user()->nama ?? '-', 0, 1)) }}
            </div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-bold text-white truncate">{{ Auth::user()->nama }}</p>
                <p class="text-[10px] text-blue-200 truncate uppercase">{{ $role }}</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="text-blue-300 hover:text-white transition-colors" title="Logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </div>
</aside>
