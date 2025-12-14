<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; background-color: #f3f4f6; }</style>
</head>
<body class="flex items-center justify-center h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-gray-100">
        <div class="text-center mb-8">
            <img src="{{ asset('image.png') }}" alt="Logo" class="inline-flex items-center justify-center w-12 h-12 bg-[#ffff] rounded-lg text-white font-bold text-xl mb-3">
            <h1 class="text-2xl font-bold text-[#00588a]">SIM-TAPING</h1>
            <p class="text-sm text-gray-500 mt-1">Sistem Manajemen Video Pembelajaran</p>
        </div>

        <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" name="email" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-[#00588a] focus:border-[#00588a] outline-none transition" placeholder="email@unsia.ac.id" required autofocus>
                @error('email') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:ring-2 focus:ring-[#00588a] focus:border-[#00588a] outline-none transition" placeholder="••••••••" required>
            </div>

            <button type="submit" class="w-full bg-[#00588a] hover:bg-[#00466e] text-white font-bold py-2.5 rounded-lg transition-colors shadow-sm">
                Masuk Sistem
            </button>
        </form>
        <!-- tester login -->
        <div class="mt-4 p-3 bg-blue-50 text-blue-800 text-xs rounded border border-blue-100">
            <p><strong>Demo Login:</strong></p>
            <p>Admin: admin@unsia.ac.id | password</p>
            <p>Dosen: farhan@unsia.ac.id | password</p>
        </div>
    </div>
</body>
</html>