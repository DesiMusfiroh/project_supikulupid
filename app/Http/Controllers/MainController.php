<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postingan;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\Penulis;
use App\Models\Log;
use App\Models\User;
use Auth;

class MainController extends Controller
{  
    public function index() {
        $postingan = Postingan::paginate(6);
        $admin_id = User::where('role','admin')->value('id');
        $rame = Postingan::where('user_id', $admin_id)->paginate(6);
        return view('main.index', compact('postingan','rame'));
    }

    public function berita() {
        $kategori = Kategori::where('nama','Berita')->value('id_kategori');
        $postingan = Postingan::where('kategori_id','=', $kategori)->where('status','published')->get();
        $title = "Berita";
        return view('main.postingan', compact('postingan','title'));
    }

    public function esai() {
        $sub_kategori = SubKategori::where('nama','Esai')->value('id_subkategori');
        $postingan = Postingan::where('subKategori_id','=', $sub_kategori)->where('status','published')->get();
        $title = "Esai";
        return view('main.postingan', compact('postingan','title'));
    }

    public function nyablak() {
        $sub_kategori = SubKategori::where('nama','nyablak')->value('id_subkategori');
        $postingan = Postingan::where('subKategori_id','=', $sub_kategori)->where('status','published')->get();
        $title = "Nyablak";
        return view('main.postingan', compact('postingan','title'));
    }

    public function inspirasi() {
        $sub_kategori = SubKategori::where('nama','inspirasi')->value('id_subkategori');
        $postingan = Postingan::where('subKategori_id','=', $sub_kategori)->where('status','published')->get();
        $title = "Inspirasi";
        return view('main.postingan', compact('postingan','title'));
    }

    public function review_buku() {
        $sub_kategori = SubKategori::where('nama','review buku')->value('id_subkategori');
        $postingan = Postingan::where('subKategori_id','=', $sub_kategori)->where('status','published')->get();
        $title = "Review Buku";
        return view('main.postingan', compact('postingan','title'));
    }

    public function puisi() {
        $sub_kategori = SubKategori::where('nama','puisi')->value('id_subkategori');
        $postingan = Postingan::where('subKategori_id','=', $sub_kategori)->where('status','published')->get();
        $title = "Puisi";
        return view('main.postingan', compact('postingan','title'));
    }

    public function cerpen() {
        $sub_kategori = SubKategori::where('nama','cerpen')->value('id_subkategori');
        $postingan = Postingan::where('subKategori_id','=', $sub_kategori)->where('status','published')->get();
        $title = "Cerpen";
        return view('main.postingan', compact('postingan','title'));
    }

    public function anekdot() {
        $sub_kategori = SubKategori::where('nama','anekdot')->value('id_subkategori');
        $postingan = Postingan::where('subKategori_id','=', $sub_kategori)->where('status','published')->get();
        $title = "Anekdot";
        return view('main.postingan', compact('postingan','title'));
    }

    public function read($id) {
        $postingan = Postingan::where('id_postingan', $id)->first();
        return view('main.read', compact('postingan'));
    }
}
