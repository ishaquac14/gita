<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

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