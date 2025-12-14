<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM-Taping UNSIA - @yield('title')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-theme { background-color: #00588a; }
        .text-theme { color: #00588a; }
        .hover-bg-theme:hover { background-color: #00588a; }
        .bg-theme-dark { background-color: #00466e; }
        .border-theme-dark { border-color: #00466e; }
        /* Badge Prodi Colors */
        .prodi-IF { @apply bg-cyan-50 text-cyan-700 border-cyan-200; }
        .prodi-KOM { @apply bg-orange-50 text-orange-700 border-orange-200; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 h-screen flex overflow-hidden">

    <!-- SIDEBAR -->
    @include('layouts.sidebar')

    <!-- MAIN CONTENT -->
    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        <!-- TOPBAR -->
        <header class="h-16 bg-white border-b border-gray-200 flex items-center justify-between px-8 z-20">
            <h2 class="text-xl font-bold text-gray-800">@yield('header_title')</h2>
            <div class="flex items-center gap-4">
                <div class="flex items-center gap-2 px-3 py-1 bg-blue-50 rounded-full border border-blue-100">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                    <span class="text-xs font-medium text-blue-800">Semester Ganjil 2023/2024</span>
                </div>
                <div class="h-8 w-px bg-gray-200"></div>
                <!-- User Info -->
                <div class="text-right">
                    <p class="text-sm font-bold text-gray-700">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Dosen' }}</p>
                </div>
            </div>
        </header>

        <!-- CONTENT AREA -->
        <div class="flex-1 overflow-y-auto bg-gray-50 p-4 md:p-8">
            @yield('content')
        </div>
    </main>

</body>
</html>