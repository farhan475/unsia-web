<aside class="w-64 bg-theme border-r border-theme-dark hidden md:flex flex-col z-10 text-white">
    <div class="h-16 flex items-center px-6 border-b border-theme-dark">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 bg-white rounded-lg flex items-center justify-center text-theme font-bold">U</div>
            <span class="font-bold text-lg text-white tracking-tight">Portal {{ ucfirst(Auth::user()->role) }}</span>
        </div>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-1 overflow-y-auto">
        <p class="px-2 text-xs font-semibold text-blue-100 uppercase tracking-wider mb-2">Menu Utama</p>
        
        @if(Auth::user()->role == 'dosen')
            <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('dashboard') ? 'bg-theme-dark shadow-sm' : 'hover:bg-theme-dark text-blue-100' }}">
                <i class="fa-solid fa-chart-line w-6 text-center mr-2"></i> Dashboard
            </a>
            <a href="{{ route('booking.create') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('booking.create') ? 'bg-theme-dark shadow-sm' : 'hover:bg-theme-dark text-blue-100' }}">
                <i class="fa-solid fa-plus w-6 text-center mr-2"></i> Ajukan Jadwal
            </a>
        @endif

        @if(Auth::user()->role == 'admin')
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-theme-dark shadow-sm' : 'hover:bg-theme-dark text-blue-100' }}">
                <i class="fa-solid fa-list-check w-6 text-center mr-2"></i> Antrian Produksi
            </a>
        @endif
        
        <a href="#" class="flex items-center px-4 py-3 text-sm font-medium rounded-lg hover:bg-theme-dark text-blue-100">
            <i class="fa-brands fa-youtube w-6 text-center mr-2"></i> Video Library
        </a>
    </nav>
    
    <!-- Logout Button -->
    <div class="border-t border-theme-dark p-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="flex items-center gap-3 text-blue-200 hover:text-white transition w-full">
                <i class="fa-solid fa-arrow-right-from-bracket"></i> Logout
            </button>
        </form>
    </div>
</aside>