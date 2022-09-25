<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PengedarController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ItemController;
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

Route::get('/', function () {
    return view('dashboard.index');
});

Route::resource('/dashboard/pengedar', PengedarController::class);

Route::resource('/dashboard/barang', BarangController::class);
Route::get('/cekNamaBarang', [BarangController::class, 'cekNama']);

Route::get('/dashboard/pesanan/cekHarga', [PesananController::class, 'cekHarga']);
Route::get('/dashboard/pesanan/getId', [PesananController::class, 'getIDCategory']);
Route::post('/hitungharga/pesanan', [PesananController::class, 'hitungHarga']);
Route::get('/dashboard/pesanan/editData', [PesananController::class, 'editData']);
Route::resource('/dashboard/pesanan', PesananController::class);

Route::resource('/dashboard/pelanggan', PelangganController::class);

Route::resource('/dashboard/peserta', PesertaController::class);

Route::resource('/dashboard/item', ItemController::class);

Route::resource('/dashboard/category', CategoryController::class);
Route::post('/operasi/hitung', [CategoryController::class, 'hitungHarga']);
Route::get('/cekCategory', [CategoryController::class, 'cekName']);

// Route::delete('/deletePeserta/{peserta:id}', function(Peserta $peserta) {
//     dd($peserta->id);
// });
