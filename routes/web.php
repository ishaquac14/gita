<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MasukController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\KeluarController;
use App\Http\Controllers\ProfileController;

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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Route untuk Stock Barang

Route::get(
    '/stock',
    [StockController::class, 'index']
)->name('stock.index');

Route::get(
    '/stock/create',
    [StockController::class, 'create']
)->name('stock.create');

Route::get(
    '/stock/edit/{id}',
    [StockController::class, 'edit']
)->name('stock.edit');

Route::put(
    '/stock/update/{id}',
    [StockController::class, 'update']
)->name('stock.update');

Route::get(
    '/stock/destroy/{id}',
    [StockController::class, 'destroy']
)->name('stock.destroy');

Route::post(
    '/stock/store',
    [StockController::class, 'store']
)->name('stock.store');

// Route untuk Barang Masuk

Route::get(
    '/masuk',
    [MasukController::class, 'index']
)->name('masuk.index');

Route::get(
    '/masuk/create',
    [MasukController::class, 'create']
)->name('masuk.create');

Route::post(
    '/masuk/store',
    [MasukController::class, 'store']
)->name('masuk.store');

Route::get(
    '/masuk/edit/{id}',
    [MasukController::class, 'edit']
)->name('masuk.edit');

Route::put(
    '/masuk/update/{id}',
    [MasukController::class, 'update']
)->name('masuk.update');

Route::get(
    '/masuk/destroy/{id}',
    [MasukController::class, 'destroy']
)->name('masuk.destroy');

// Route barang keluar

Route::get(
    '/keluar',
    [KeluarController::class, 'index']
)->name('keluar.index');

Route::post(
    '/keluar/store',
    [KeluarController::class, 'store']
)->name('keluar.store');

Route::put(
    '/keluar/update/{id}',
    [KeluarController::class, 'update']
)->name('keluar.update');

Route::get(
    '/keluar/edit/{id}',
    [KeluarController::class, 'edit']
)->name('keluar.edit');

Route::get(
    '/keluar/destroy/{id}',
    [KeluarController::class, 'destroy']
)->name('keluar.destroy');