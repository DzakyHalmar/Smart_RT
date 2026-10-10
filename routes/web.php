
<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/profil-rt', [HomeController::class, 'profil'])
    ->name('profil');

Route::get('/pengurus', [HomeController::class, 'pengurus'])
    ->name('pengurus');

Route::get('/pengumuman', [HomeController::class, 'pengumuman'])
    ->name('pengumuman');

Route::get('/transparansi-keuangan', [HomeController::class, 'keuangan'])
    ->name('keuangan');
