<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\PengajuanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\SuperAdmin\DashboardController as SuperAdminDashboardController;
use App\Http\Controllers\SuperAdmin\UserController;

/*
|--------------------------------------------------------------------------
| PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return redirect()->route('login');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/login', [LoginController::class, 'show'])->name('login');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| USER (PENGAJUAN SURAT)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:user'])->group(function () {

    Route::get('/pengajuan/create', [PengajuanController::class, 'create'])
        ->name('pengajuan.create');

    Route::post('/pengajuan', [PengajuanController::class, 'store'])
        ->name('pengajuan.store');
});

/*
|--------------------------------------------------------------------------
| ADMIN (HANYA PROSES SURAT)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    Route::get('/pengajuan/{pengajuan}', 
        [DashboardController::class, 'show'])
        ->name('pengajuan.show');

    Route::post('/pengajuan/{pengajuan}/status', 
        [DashboardController::class, 'updateStatus'])
        ->name('pengajuan.update-status');
});

/*
|--------------------------------------------------------------------------
| SUPER ADMIN (KELOLA USER & LIHAT SURAT)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:super_admin'])
    ->prefix('super-admin')
    ->as('super_admin.')
    ->group(function () {

    // Dashboard
    Route::get('/dashboard', [SuperAdminDashboardController::class, 'index'])
        ->name('dashboard');

    // Detail Surat (Read Only)
    Route::get('/pengajuan/{pengajuan}', 
        [SuperAdminDashboardController::class, 'show'])
        ->name('pengajuan.show');

    // RESOURCE USERS (TIDAK DOBEL)
    Route::resource('users', UserController::class);
});