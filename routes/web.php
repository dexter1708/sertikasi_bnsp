<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PembeliController;
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

Route::get('/pembeli', [PembeliController::class, 'index'])->name('pembeli.index');
Route::get('/pembeli/create', [PembeliController::class, 'create'])->name('pembeli.create');
Route::post('/pembeli', [PembeliController::class, 'store'])->name('pembeli.store');
Route::get('/pembeli/{pembeli}/edit', [PembeliController::class, 'edit'])->name('pembeli.edit');
Route::put('/pembeli/{pembeli}', [PembeliController::class, 'update'])->name('pembeli.update');
Route::delete('/pembeli/{pembeli}', [PembeliController::class, 'destroy'])->name('pembeli.destroy');

Route::get('/',[BukuController::class, 'index']) -> name('home');
Route::get('/input',[BukuController::class, 'input']);
Route::get('/listbuku', [BukuController::class, 'listbuku'])->name('listBuku');
Route::post('/buku',[BukuController::class, 'buku']);
Route::get('/edit/{buku_id}',[BukuController::class, 'edit']);
Route::put('/{buku_id}',[BukuController::class, 'update']);
Route::delete('/{buku_id}',[BukuController::class, 'delete']);

Route::get('/order/create', [OrderController::class, 'create']) -> name('create_order');
Route::post('/order', [OrderController::class, 'order'])->name('orders');
Route::get('/orders', [OrderController::class, 'orders'])->name('list_order');
Route::put('/orders/{order_id}', [OrderController::class, 'update'])->name('orders.update');
Route::get('/orders/{order_id}', [OrderController::class, 'show'])->name('orders.show');
Route::get('/{order_id}/edit', [OrderController::class, 'edit'])->name('orders.edit');
Route::delete('/orders/{order_id}', [OrderController::class, 'destroy'])->name('orders.destroy');




