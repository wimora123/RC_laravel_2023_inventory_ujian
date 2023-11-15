<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\MasterBarangController;
use App\Http\Controllers\MasterKategoriController;
use App\Http\Controllers\MasterGudangController;
use App\Http\Controllers\StokGudangController;

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
    return view('welcome');
});

// Route::get('/password', function(){
//     $password = 'admin';
// $hashedPassword = Hash::make($password);
// echo $hashedPassword;
// });

// Password: $2y$10$a7dngVSF24Brta.mvUwniujlvaE5YOw66xBVsPOm.SOUNMBtXjHmy

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('kirim_data_login');

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
Route::get('/master', [MasterController::class, 'index'])->name('master')->middleware('auth');

Route::get('/master/barang', [MasterBarangController::class, 'index'])->name('master_barang')->middleware('auth');
Route::get('/master/barang/tambah', [MasterBarangController::class, 'create'])->name('master_barang_create')->middleware('auth');
Route::post('/master/barang/simpan', [MasterBarangController::class, 'store'])->name('master_barang_simpan')->middleware('auth');;

Route::get('/master/barang/hapus/{id}',
    [MasterBarangController::class, 'destroy'])
    ->name('master_barang_hapus')
    ->where('id', '[0-9]+')
    ->middleware('auth');

Route::get('/master/barang/detail/{id}', [MasterBarangController::class, 'show'])
->name('master_barang_detail')
->where('id', '[0-9]+')
->middleware('auth');

Route::get('/master/barang/edit/{id}',
    [MasterBarangController::class, 'edit'])
    ->name('master_barang_edit')
    ->where('id', '[0-9]+')
    ->middleware('auth');

Route::post('/master/barang/update/{id}', [MasterBarangController::class, 'update'])
->name('master_barang_update')
->where('id', '[0-9]+')
->middleware('auth');

Route::get('/barang_nonaktif', [MasterBarangController::class, 'barang_nonaktif'])->name('barang_nonaktif')->middleware('auth');
Route::get('/barang_nonaktif/hapus_barang_permanent/{id}',
    [MasterBarangController::class, 'hapus_permanent'])
    ->name('hapus_barang_permanent')
    ->where('id', '[0-9]+')
    ->middleware('auth');

Route::get('/master/barang/restore/{id}',
    [MasterBarangController::class, 'restore'])
    ->name('master_barang_restore')
    ->where('id', '[0-9]+')
    ->middleware('auth');

Route::get('/master/kategori', [MasterKategoriController::class, 'index'])->name('master_kategori')->middleware('auth');
Route::get('/master/kategori/create', [MasterKategoriController::class, 'create'])->name('master_kategori_create')->middleware('auth');
Route::post('/master/kategori/simpan', [MasterKategoriController::class, 'store'])->name('master_kategori_simpan')->middleware('auth');
Route::get('/master/kategori/edit/{id}',
    [MasterKategoriController::class, 'edit'])
    ->name('master_kategori_edit')
    ->where('id', '[0-9]+')
    ->middleware('auth');
Route::post('/master/kategori/update/{id}',
    [MasterKategoriController::class, 'update'])
    ->name('master_kategori_update')
    ->where('id', '[0-9]+')
    ->middleware('auth');
Route::get('/master/kategori/hapus/{id}',
    [MasterKategoriController::class, 'destroy'])
    ->name('master_kategori_hapus')
    ->where('id', '[0-9]+')
    ->middleware('auth');

Route::get('/master/gudang', [MasterGudangController::class, 'index'])->name('master_gudang')->middleware('auth');

Route::get('/stok_masuk', [StokGudangController::class, 'form_stok_masuk'])->name('form_stok_masuk')->middleware('auth');
Route::post('/stok_in', [StokGudangController::class, 'proses_stok_masuk'])->name('stok_in')->middleware('auth');

Route::get('/stok_keluar', [StokGudangController::class, 'form_stok_keluar'])->name('form_stok_keluar')->middleware('auth');
Route::post('/stok_out', [StokGudangController::class, 'proses_stok_keluar'])->name('stok_out')->middleware('auth');

Route::get('/laporan', [StokGudangController::class, 'laporan_stok'])->name('laporan')->middleware('auth');
