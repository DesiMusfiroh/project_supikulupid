<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SubKategoriController;
use App\Http\Controllers\HomeController;

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

Route::get('/home', [HomeController::class , 'index'])->name('home');

// route penulis
Route::group(['middleware' => ['auth', 'checkRole:penulis']],function(){
    Route::get('/postingan_penulis',[PenulisController::class, 'postingan'])->name('postingan.penulis');
    Route::get('/logs_penulis',[PenulisController::class, 'logs'])->name('logs.penulis');
    Route::get('/profil/edit',[PenulisController::class, 'profil'])->name('profil.penulis');
    Route::patch('/profil/update',[PenulisController::class, 'updateProfil'])->name('profil.update');

    // postingan penulis
    Route::get('/postingan/create',[PostinganController::class, 'create'])->name('postingan.create');
    Route::get('/postingan/{id}',[PostinganController::class, 'show'])->name('postingan.show');
    Route::post('/postingan/store',[PostinganController::class, 'store'])->name('postingan.store');
    Route::patch('/postingan/update',[PostinganController::class, 'update'])->name('postingan.update');
    Route::post('/postingan/delete',[PostinganController::class, 'delete'])->name('postingan.delete');
    Route::get('/postingan/send/{id}',[PostinganController::class, 'send'])->name('postingan.send');
});


// route admin  
Route::group(['middleware' => ['auth', 'checkRole:admin']],function(){ 
    // admin kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::patch('/kategori/update', [KategoriController::class, 'update'])->name('kategori.update');
    Route::get('/kategori/{id}',[KategoriController::class, 'destroy'])->name('kategori.delete');

    // admin sub kategori
    Route::get('/subkategori',[SubKategoriController::class, 'index'])->name('subkategori');
    Route::post('/subkategori/store', [SubKategoriController::class, 'store'])->name('subkategori.store');
    Route::patch('/subkategori/update', [SubKategoriController::class, 'update'])->name('subkategori.update');
    Route::get('/subkategori/{id}',[SubKategoriController::class, 'destroy'])->name('subkategori.delete');

    // postingan penulis di admin
    Route::get('/postingan_all', [PostinganController::class, 'indexAll'])->name('postingan.all');
    // Route::get('/postingan',[PostinganController::class, 'index'])->name('postingan');

    //Admin Postingan
    Route::get('/postingan',[App\Http\Controllers\PostinganController::class, 'index'])->name('postingan');
    Route::get('/tambahPostingan',[App\Http\Controllers\PostinganController::class, 'create'])->name('tambahPostingan');    

    // aktivitas admin
    Route::get('/logs_admin',[AdminController::class, 'logs'])->name('logs.admin');

});  
