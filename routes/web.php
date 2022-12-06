<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\EkspedisiController;
use App\Http\Controllers\PembeliController;
use App\Http\Controllers\PenjualController;
use App\Http\Controllers\JoinController;
use App\Http\Controllers\PajakController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('admin.index');
// });
Route :: get("/",[LoginController::class,'showLoginForm'])->name('login');
Route::get('join', [JoinController::class, 'join'])->name('join');

Route ::prefix("barang")->group(function(){
Route::get('/', [BarangController::class, 'index'])->name('barang.index');
Route::get('add', [BarangController::class, 'create'])->name('barang.create');
Route::post('store', [BarangController::class, 'store'])->name('barang.store');
Route::get('edit/{id}', [BarangController::class, 'edit'])->name('barang.edit');
Route::post('update/{id}', [BarangController::class, 'update'])->name('barang.update');
Route::post('delete/{id}', [BarangController::class, 'delete'])->name('barang.delete');
});
Route ::prefix("ekspedisi")->group(function(){
Route::get('/', [EkspedisiController::class, 'index'])->name('ekspedisi.index');
Route::get('add', [EkspedisiController::class, 'create'])->name('ekspedisi.create');
Route::post('store', [EkspedisiController::class, 'store'])->name('ekspedisi.store');
Route::get('edit/{id}', [EkspedisiController::class, 'edit'])->name('ekspedisi.edit');
Route::post('update/{id}', [EkspedisiController::class, 'update'])->name('ekspedisi.update');
Route::post('delete/{id}', [EkspedisiController::class, 'delete'])->name('ekspedisi.delete');
});
Route ::prefix("pembeli")->group(function(){
    Route::get('/', [PembeliController::class, 'index'])->name('pembeli.index');
    Route::get('add', [PembeliController::class, 'create'])->name('pembeli.create');
    Route::post('store', [PembeliController::class, 'store'])->name('pembeli.store');
    Route::get('edit/{id}', [PembeliController::class, 'edit'])->name('pembeli.edit');
    Route::post('update/{id}', [PembeliController::class, 'update'])->name('pembeli.update');
    Route::post('delete/{id}', [PembeliController::class, 'delete'])->name('pembeli.delete');
    });
    Route ::prefix("penjual")->group(function(){
        Route::get('/', [PenjualController::class, 'index'])->name('penjual.index');
        Route::get('add', [PenjualController::class, 'create'])->name('penjual.create');
        Route::post('store', [PenjualController::class, 'store'])->name('penjual.store');
        Route::get('edit/{id}', [PenjualController::class, 'edit'])->name('penjual.edit');
        Route::post('update/{id}', [PenjualController::class, 'update'])->name('penjual.update');
        Route::post('delete/{id}', [PenjualController::class, 'delete'])->name('penjual.delete');
        Route::post('recycle/{id}', [PenjualController::class, 'recycle'])->name('penjual.recycle');
        Route::get('restore/{id}', [PenjualController::class, 'restore'])->name('penjual.restore');
        });


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
