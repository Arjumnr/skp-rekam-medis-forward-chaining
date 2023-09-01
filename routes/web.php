<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasienController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('authLogin');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('pasien')->group(function () {
        Route::get('/', [PasienController::class, 'index'])->name('pasien');

        // // Route::get('/create', [PertanyaanController::class, 'create'])->name('pertanyaan.create');
        Route::post('/store', [PasienController::class, 'store'])->name('pasien.store');
        Route::get('/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
        // Route::post('/update/{id}', [PasienController::class, 'update'])->name('pertanyaan.update');
        Route::delete('/store/{id}', [PasienController::class, 'destroy'])->name('pasien.delete');
    });



    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
