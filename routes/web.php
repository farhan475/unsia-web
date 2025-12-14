<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController, BookingController,
    DashboardController, DosenController, LibraryController,
    WorkflowController
};



// --- AUTHENTIKASI ---
// Halaman Login
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
// Proses Login
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
// Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// --- RUTE TERLINDUNGI (Membutuhkan Login) ---
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Utama (Redirect ke halaman role spesifik)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ---- RUTE UNTUK DOSEN ----
    Route::middleware(['role:dosen'])->group(function () {
        // Resource Booking (Hanya index, create, store)
        Route::resource('bookings', BookingController::class)->only(['index', 'create', 'store']);
    });

    // ---- RUTE UNTUK ADMIN ----
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        // Dashboard Admin & Antrian Produksi
        Route::get('/queue', [WorkflowController::class, 'index'])->name('queue');
        
        // Update Status Booking (Approve, Reject, Advance)
        Route::patch('/workflow/{booking}/status', [WorkflowController::class, 'updateStatus'])->name('workflow.update');
        
        // Publish Video ke Library
        Route::post('/workflow/{booking}/publish', [WorkflowController::class, 'publish'])->name('workflow.publish');
        
        // CRUD Dosen
        Route::resource('dosen', DosenController::class)->except(['show']); // Tidak perlu show
    });

    // ---- RUTE UMUM (Bisa diakses semua setelah login) ----
    // Video Library
    Route::get('/library', [LibraryController::class, 'index'])->name('library.index');
    
    // Halaman Panduan (Statis)
    Route::view('/panduan', 'pages.panduan')->name('panduan');
});