<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM-Taping UNSIA - @yield('title')</title>
    
    <!-- Vite for Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- FontAwesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- AlpineJS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Warna Utama */
        .bg-theme { background-color: #00588a; }
        .text-theme { color: #00588a; }
        .hover-bg-theme:hover { background-color: #00466e; }
        .bg-theme-dark { background-color: #00466e; }
        /* Status Badges (Lebih Spesifik) */
        .status-badge-pending { @apply bg-yellow-100 text-yellow-800 border border-yellow-200 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider; }
        .status-badge-approved { @apply bg-blue-100 text-[#00588a] border border-blue-200 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider; }
        .status-badge-editing { @apply bg-orange-100 text-orange-800 border border-orange-200 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider; }
        .status-badge-published { @apply bg-green-100 text-green-800 border border-green-200 px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider; }
    </style>
</head>
<body class="bg-gray-50 h-screen flex overflow-hidden">

    @include('components.sidebar')

    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        @include('components.navbar')

        <div class="flex-1 overflow-y-auto p-4 md:p-8">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 shadow-sm flex items-start gap-3">
                    <i class="fa-solid fa-check-circle text-green-500 mt-0.5"></i>
                    <div>
                        <p class="text-sm font-bold">Sukses</p>
                        <p class="text-sm">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 text-red-700 p-4 shadow-sm flex items-start gap-3">
                    <i class="fa-solid fa-triangle-exclamation text-red-500 mt-0.5"></i>
                    <div>
                        <p class="text-sm font-bold">Error</p>
                        <p class="text-sm">{{ session('error') }}</p>
                    </div>
                </div>
            @endif
            
            @yield('content')
        </div>
    </main>
</body>
</html>