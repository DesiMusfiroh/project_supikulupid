<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SubKategoriController;
use App\Http\Controllers\MainController;


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


// auth pages
Auth::routes();

Route::get('/home',[HomeController::class, 'index'])->name('home');

// route admin and penulis
Route::post('/postingan/delete',[PostinganController::class, 'delete'])->name('postingan.delete');
Route::patch('/postingan/update',[PostinganController::class, 'update'])->name('postingan.update');

// route penulis
Route::group(['middleware' => ['auth', 'checkRole:penulis']],function(){
    Route::get('/postingan_penulis',[PenulisController::class, 'postingan'])->name('postingan.penulis');
    Route::get('/logs_penulis',[PenulisController::class, 'logs'])->name('logs.penulis');
    Route::get('/profil/edit',[PenulisController::class, 'profil'])->name('profil.penulis');
    Route::patch('/profil/update',[PenulisController::class, 'updateProfil'])->name('profil.update');
    Route::patch('/profil/update_image',[PenulisController::class, 'updateImage'])->name('profil.update.image');

    // postingan penulis
    Route::get('/postingan/create',[PostinganController::class, 'create'])->name('postingan.create');
    Route::get('/postingan/{id}',[PostinganController::class, 'show'])->name('postingan.show');
    Route::post('/postingan/store',[PostinganController::class, 'store'])->name('postingan.store');
    Route::get('/postingan/send/{id}',[PostinganController::class, 'send'])->name('postingan.send');
    Route::patch('/postingan/update',[PostinganController::class, 'update'])->name('postingan.update');

    // pengaturan_penulis
    Route::get('/pengaturan_penulis',[PenulisController::class, 'pengaturan'])->name('pengaturan.penulis');
    Route::post('change_password_penulis', [PenulisController::class, 'changePassword'])->name('change.password.penulis');
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
    
    // postingan admin 
    Route::get('/postingan_admin',[AdminController::class, 'postingan'])->name('postingan.admin');
    Route::get('/postingan_admin/create',[PostinganController::class, 'adminCreate'])->name('postingan_admin.create');
    Route::post('/postingan_admin/store',[PostinganController::class, 'adminStore'])->name('postingan_admin.store');
    Route::get('/postingan_admin/{id}',[PostinganController::class, 'adminEdit'])->name('postingan_admin.edit');
    Route::patch('/postingan_admin/update',[PostinganController::class, 'adminUpdate'])->name('postingan_admin.update');
    Route::get('/postingan_admin/publish/{id}',[PostinganController::class, 'adminPublish'])->name('postingan_admin.publish');

    // postingan penulis di admin
    Route::get('/postingan_all', [PostinganController::class, 'indexAll'])->name('postingan.all');


    Route::get('/postingan_detail/{id}',[PostinganController::class, 'detail'])->name('postingan.detail');
    Route::post('/postingan/publish',[PostinganController::class, 'publish'])->name('postingan.publish');
    Route::post('/postingan/reject',[PostinganController::class, 'reject'])->name('postingan.reject');
  
    //Admin Postingan
    Route::get('/postingan',[PostinganController::class, 'index'])->name('postingan');
    Route::get('/tambahPostingan',[PostinganController::class, 'create'])->name('tambahPostingan');    
 

    // aktivitas admin
    Route::get('/logs_admin',[AdminController::class, 'logs'])->name('logs.admin'); 

    // pengaturan admin
    Route::get('/pengaturan_admin',[AdminController::class, 'pengaturan'])->name('pengaturan.admin');
    Route::post('change_password_admin', [AdminController::class, 'changePassword'])->name('change.password.admin');

});  

// route ajax
Route::get('postingan/create/getsubkategori/{id}', [PostinganController::class, 'getSubKategori']);
Route::get('postingan_admin/create/getsubkategori/{id}', [PostinganController::class, 'getSubKategori']);
Route::post('upload_image_editor',[PostinganController::class, 'uploadImageEditor'])->name('upload.image');

Route::get('getnotificationadmin', [AdminController::class, 'getNotification']);
Route::get('getnotificationpenulis', [PenulisController::class, 'getNotification']);





// main pages
Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/berita', [MainController::class, 'berita'])->name('berita');
Route::get('/esai', [MainController::class, 'esai'])->name('esai');
Route::get('/nyablak', [MainController::class, 'nyablak'])->name('nyablak');
Route::get('/inspirasi', [MainController::class, 'inspirasi'])->name('inspirasi');
Route::get('/review_buku', [MainController::class, 'review_buku'])->name('review_buku');
Route::get('/puisi', [MainController::class, 'puisi'])->name('puisi');
Route::get('/cerpen', [MainController::class, 'cerpen'])->name('cerpen');
Route::get('/anekdot', [MainController::class, 'anekdot'])->name('anekdot');

Route::get('/{id}', [MainController::class, 'read'])->name('read');
