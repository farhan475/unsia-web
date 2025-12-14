<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    BookingController,
    DashboardController,
    DosenController,
    LibraryController,
    WorkflowController
};

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::middleware(['role:dosen'])->group(function () {
        Route::resource('bookings', BookingController::class)->only(['index', 'create', 'store']);
    });

    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'adminIndex'])->name('dashboard');
        Route::get('/queue', [WorkflowController::class, 'index'])->name('queue');
        Route::patch('/workflow/{booking}/status', [WorkflowController::class, 'updateStatus'])->name('workflow.update');
        Route::post('/workflow/{booking}/publish', [WorkflowController::class, 'publish'])->name('workflow.publish');
        Route::resource('dosen', DosenController::class)->except(['show']);
    });

    Route::get('/library', [LibraryController::class, 'index'])->name('library.index');
    Route::view('/panduan', 'pages.dosen.panduan')->name('panduan');
});
