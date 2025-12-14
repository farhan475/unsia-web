<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIM-Taping UNSIA - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .bg-theme { background-color: #00588a; }
        .bg-theme-dark { background-color: #00466e; }
        .text-theme { color: #00588a; }
        .border-theme { border-color: #00588a; }
        .border-theme-dark { border-color: #00466e; }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 h-screen flex overflow-hidden">
    @include('components.sidebar')
    <main class="flex-1 flex flex-col h-screen overflow-hidden relative">
        @include('components.navbar')
        <div class="flex-1 overflow-y-auto p-6 md:p-8">
            @if(session('success'))
                <div class="mb-6 bg-green-50 border-l-4 border-green-500 p-4 rounded shadow-sm flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-green-600"></i>
                    <div>
                        <p class="text-sm font-bold text-green-800">Berhasil</p>
                        <p class="text-xs text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
            @if(session('error') || $errors->any())
                <div class="mb-6 bg-red-50 border-l-4 border-red-500 p-4 rounded shadow-sm flex items-center gap-3">
                    <i class="fa-solid fa-circle-exclamation text-red-600"></i>
                    <div>
                        <p class="text-sm font-bold text-red-800">Perhatian</p>
                        <p class="text-xs text-red-700">{{ session('error') ?? 'Terdapat kesalahan pada inputan.' }}</p>
                    </div>
                </div>
            @endif
            @yield('content')
        </div>
    </main>
</body>
</html>
