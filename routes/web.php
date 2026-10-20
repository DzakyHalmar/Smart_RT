
<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\WargaController;
use App\Http\Controllers\Admin\IuranController;
use App\Http\Controllers\Admin\KeuanganController;
use App\Http\Controllers\Admin\PengeluaranController;
use App\Http\Controllers\Admin\PengurusController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profil-rt', [HomeController::class, 'profil'])
    ->name('profil');

Route::get('/pengurus', [HomeController::class, 'pengurus'])
    ->name('pengurus');

Route::get('/pengumuman', [HomeController::class, 'pengumuman'])
    ->name('pengumuman');

Route::get('/transparansi-keuangan', [HomeController::class, 'keuangan'])
    ->name('keuangan');

    // Autentikasi admin
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('warga', WargaController::class);

    Route::get('/iuran', [IuranController::class, 'index'])
        ->name('iuran.index');

    Route::get('/iuran/{warga}/kartu', [IuranController::class, 'kartu'])
        ->name('iuran.kartu');

    Route::post('/iuran/{warga}/bayar', [IuranController::class, 'bayar'])
        ->name('iuran.bayar');

    Route::delete('/iuran/{warga}/batal-bayar', [IuranController::class, 'batalBayar'])
        ->name('iuran.batal-bayar');

    // Route CRUD transaksi lama.
    Route::resource('iuran', IuranController::class)
        ->except(['index']);

    Route::get('/keuangan', [KeuanganController::class, 'index'])->name('keuangan');

    Route::resource('pengeluaran', PengeluaranController::class);

    Route::resource('pengurus', PengurusController::class)
        ->parameters(['pengurus' => 'pengurus']);
});

