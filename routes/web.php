<?php

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// admin kategori
Route::get('/kategori', [App\Http\Controllers\KategoriController::class, 'index'])->name('kategori');
Route::post('/tambahKategori', [App\Http\Controllers\KategoriController::class, 'store'])->name('tambahKategori');
Route::patch('/kategori/update', [App\Http\Controllers\KategoriController::class, 'update'])->name('updateKategori');
Route::get('/kategori/{id_kategori}',[App\Http\Controllers\KategoriController::class, 'destroy'])->name('deleteKategori');

//admin sub kategori
Route::get('/subKategori',[App\Http\Controllers\SubKategoriController::class, 'index'])->name('subKategori');
Route::post('/tambahSubKategori', [App\Http\Controllers\SubKategoriController::class, 'store'])->name('tambahSubKategori');
Route::patch('/subKategori/update', [App\Http\Controllers\SubKategoriController::class, 'update'])->name('updateSubKategori');
Route::get('/subkategori/{id_subkategori}',[App\Http\Controllers\SubKategoriController::class, 'destroy'])->name('deleteSubKategori');

//Admin Postingan
Route::get('/postingan',[App\Http\Controllers\PostinganController::class, 'index'])->name('postingan');
Route::get('/tambahPostingan',[App\Http\Controllers\PostinganController::class, 'create'])->name('tambahPostingan');
// Route::get('/tambahPostingan/{id}')