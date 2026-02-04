<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\PengajuanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;

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
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

/*
|--------------------------------------------------------------------------
| DASHBOARD UMUM (SETELAH LOGIN)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('auth')->name('dashboard');

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
| ADMIN
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    Route::get('/pengajuan/live', function () {
        return \App\Models\Pengajuan::latest()->get();
    });

    // dashboard admin
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');



    // lihat detail pengajuan
    Route::get('/pengajuan/{pengajuan}', [DashboardController::class, 'show'])
        ->name('admin.pengajuan.show');

    // update status pengajuan
    Route::post('/pengajuan/{pengajuan}/status', [DashboardController::class, 'updateStatus'])
        ->name('admin.pengajuan.update-status');

    // manajemen user
    Route::get('/users', [UserController::class, 'index'])
        ->name('admin.users.index');

    Route::get('/users/create', [UserController::class, 'create'])
        ->name('admin.users.create');

    Route::post('/users', [UserController::class, 'store'])
        ->name('admin.users.store');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])
        ->name('admin.users.edit');

    Route::put('/users/{user}', [UserController::class, 'update'])
        ->name('admin.users.update');

    Route::delete('/users/{user}', [UserController::class, 'destroy'])
        ->name('admin.users.destroy');
});

Route::post('/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');
