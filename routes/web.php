<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\PostinganController;

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

Route::get('/home', function(){
    if (Auth::user()->role == 'admin'){
        return view('admin.index');
    } else if (Auth::user()->role == 'penulis'){
        return view('penulis.index');
    }
});

// route penulis
Route::group(['middleware' => ['auth', 'checkRole:penulis']],function(){
    Route::get('/postingan_penulis',[PenulisController::class, 'postingan'])->name('postingan.penulis');
    Route::get('/logs_penulis',[PenulisController::class, 'logs'])->name('logs.penulis');
    Route::get('/profil/edit',[PenulisController::class, 'profil'])->name('profil.penulis');
    Route::patch('/profil/update',[PenulisController::class, 'updateProfil'])->name('profil.update');

    Route::get('/postingan/create',[PostinganController::class, 'create'])->name('postingan.create');
    Route::get('/postingan/{id}',[PostinganController::class, 'show'])->name('postingan.show');
    Route::post('/postingan/store',[PostinganController::class, 'store'])->name('postingan.store');
    Route::patch('/postingan/update',[PostinganController::class, 'update'])->name('postingan.update');
    Route::post('/postingan/delete',[PostinganController::class, 'delete'])->name('postingan.delete');
    Route::get('/postingan/send/{id}',[PostinganController::class, 'send'])->name('postingan.send');
});


// route admin  
Route::group(['middleware' => ['auth', 'checkRole:penulis']],function(){ 
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
});  
