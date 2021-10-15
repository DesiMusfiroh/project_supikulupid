<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenulisController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostinganController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\SubKategoriController;


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
    // Route::get('/postingan',[PostinganController::class, 'index'])->name('postingan');


    //Admin Postingan
    Route::get('/admin/postingan',[App\Http\Controllers\AdminPostinganController::class, 'indexAdmin'])->name('adminPostingan');
    Route::get('/admin/data_tulisan',[App\Http\Controllers\AdminPostinganController::class, 'dataTulisan'])->name('dataTulisan'); 
    Route::get('/admin/tambahPostingan',[App\Http\Controllers\AdminPostinganController::class, 'createAdmin'])->name('tambahPostingan');
    Route::post('/admin/postingan/create',[App\Http\Controllers\AdminPostinganController::class, 'subCat'])->name('createSubKategori');
    Route::post('/admin/postingan/store',[App\Http\Controllers\AdminPostinganController::class, 'storeAdmin'])->name('storePostingan');  
    Route::post('/admin/postingan/delete',[App\Http\Controllers\AdminPostinganController::class, 'deleteAdmin'])->name('deletePostingan');

    Route::get('/admin/tambahPostingan',[App\Http\Controllers\AdminPostinganController::class, 'createAdmin'])->name('tambahPostingan');


    Route::get('/admin/postingan{id}',[App\Http\Controllers\AdminPostinganController::class, 'showAdmin'])->name('showPostingan');
    Route::patch('/admin/update',[App\Http\Controllers\AdminPostinganController::class, 'updateAdmin'])->name('updatePostingan');

    Route::get('/admin/data_tulisan',[App\Http\Controllers\AdminPostinganController::class, 'dataTulisan'])->name('dataTulisan'); 

    Route::get('/admin/send/{id}',[App\Http\Controllers\AdminPostinganController::class, 'sendAdmin'])->name('sendPostingan');
    Route::get('/admin/publish/{id}',[App\Http\Controllers\AdminPostinganController::class, 'publishAdmin'])->name('publishPostingan');
    Route::get('/admin/reject/{id}',[App\Http\Controllers\AdminPostinganController::class, 'rejectPostingan'])->name('rejectPostingan');




    // aktivitas admin
    Route::get('/logs_admin',[AdminController::class, 'logs'])->name('logs.admin');


// //Admin Postingan
// Route::get('/postingan',[App\Http\Controllers\PostinganController::class, 'index'])->name('postingan');
// Route::get('/postingan/tambah',[App\Http\Controllers\PostinganController::class, 'create'])->name('tambahPostingan');
// Route::get('/tambahPostingan/{id}')

});  
