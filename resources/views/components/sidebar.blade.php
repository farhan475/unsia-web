<aside class="w-64 bg-theme border-r border-theme-dark hidden md:flex flex-col z-10 text-white">
    <!-- Logo Area -->
    <div class="h-16 flex items-center px-6 border-b border-theme-dark">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-theme font-bold">U</div>
            <span class="font-bold text-lg text-white tracking-tight">Portal Dosen</span>
        </div>
    </div>

    <!-- Navigation -->
    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
        @if(Auth::user()->role == 'admin')
            <p class="px-2 text-[10px] font-bold text-blue-200 uppercase tracking-wider mb-2 mt-2">Admin Control</p>
            <a href="{{ route('admin.queue') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.queue') ? 'bg-theme-dark shadow-sm' : 'text-blue-100 hover:bg-theme-dark hover:text-white' }}">
                <i class="fa-solid fa-list-check w-6 text-center mr-2"></i> Antrian Produksi
            </a>
            <a href="{{ route('admin.dosen.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.dosen.*') ? 'bg-theme-dark shadow-sm' : 'text-blue-100 hover:bg-theme-dark hover:text-white' }}">
                <i class="fa-solid fa-users w-6 text-center mr-2"></i> Data Dosen
            </a>
        @else
            <p class="px-2 text-[10px] font-bold text-blue-200 uppercase tracking-wider mb-2 mt-2">Menu Dosen</p>
            <a href="{{ route('bookings.index') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('bookings.index') ? 'bg-theme-dark shadow-sm' : 'text-blue-100 hover:bg-theme-dark hover:text-white' }}">
                <i class="fa-solid fa-chart-line w-6 text-center mr-2"></i> Dashboard & Jadwal
            </a>
            <a href="{{ route('bookings.create') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('bookings.create') ? 'bg-theme-dark shadow-sm' : 'text-blue-100 hover:bg-theme-dark hover:text-white' }}">
                <i class="fa-solid fa-plus w-6 text-center mr-2"></i> Ajukan Jadwal
            </a>
        @endif

        <p class="px-2 text-[10px] font-bold text-blue-200 uppercase tracking-wider mt-6 mb-2">Bantuan</p>
        <a href="{{ route('panduan') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('panduan') ? 'bg-theme-dark shadow-sm' : 'text-blue-100 hover:bg-theme-dark hover:text-white' }}">
            <i class="fa-solid fa-circle-question w-6 text-center mr-2"></i> Panduan Taping
        </a>
    </nav>

    <!-- User Profile -->
    <div class="border-t border-theme-dark p-4">
        <div class="flex items-center gap-3">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=ffffff&color=00588a&size=36" alt="User" class="w-9 h-9 rounded-full border-2 border-theme-dark">
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-xs text-blue-100 truncate uppercase">{{ auth()->user()->role }}</p>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="text-blue-200 hover:text-white transition-colors p-2">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </button>
            </form>
        </div>
    </div>
</aside>