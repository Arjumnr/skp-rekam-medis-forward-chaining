<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DatasController;
use App\Http\Controllers\GejalaController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\UserController;

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
Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('authLogin');

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('pasien')->group(function () {
        Route::get('/', [PasienController::class, 'index'])->name('pasien');
        Route::post('/store', [PasienController::class, 'store'])->name('pasien.store');
        Route::get('/{id}/edit', [PasienController::class, 'edit'])->name('pasien.edit');
        Route::delete('/store/{id}', [PasienController::class, 'destroy'])->name('pasien.delete');
    });

    Route::prefix('gejala')->group(function () {
        Route::get('/', [GejalaController::class, 'index'])->name('gejala');
        Route::post('/store', [GejalaController::class, 'store'])->name('gejala.store');
        Route::get('/{id}/edit', [GejalaController::class, 'edit'])->name('gejala.edit');
        Route::delete('/store/{id}', [GejalaController::class, 'destroy'])->name('gejala.delete');
    });

    Route::prefix('tindakan')->group(function () {
        Route::get('/', [TindakanController::class, 'index'])->name('tindakan');
        Route::post('/store', [TindakanController::class, 'store'])->name('tindakan.store');
        Route::get('/{id}/edit', [TindakanController::class, 'edit'])->name('tindakan.edit');
        Route::delete('/store/{id}', [TindakanController::class, 'destroy'])->name('tindakan.delete');
    });

    Route::prefix('rule')->group(function () {
        Route::get('/', [RuleController::class, 'index'])->name('rule');
        Route::post('/store', [RuleController::class, 'store'])->name('rule.store');
        Route::get('/{id}/edit', [RuleController::class, 'edit'])->name('rule.edit');
        Route::delete('/store/{id}', [RuleController::class, 'destroy'])->name('rule.delete');
    });

    Route::prefix('datas')->group(function () {
        Route::get('/', [DatasController::class, 'index'])->name('datas');
        Route::post('/store', [DatasController::class, 'store'])->name('datas.store');
        Route::get('/{id}/edit', [DatasController::class, 'edit'])->name('datas.edit');
        Route::delete('/store/{id}', [DatasController::class, 'destroy'])->name('datas.delete');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('user');
        Route::post('/store', [UserController::class, 'store'])->name('user.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::delete('/store/{id}', [UserController::class, 'destroy'])->name('user.delete');
    });



    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
