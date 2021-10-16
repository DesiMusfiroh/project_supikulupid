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
        return view('main.index', compact('postingan'));
    }

    public function berita() {
        $kategori = Kategori::where('nama','Berita')->value('id_kategori');
        $postingan = Postingan::where('kategori_id', $kategori)->get();
        $title = "Berita";
        return view('main.postingan', compact('postingan','title'));
    }

    public function esai() {
        $sub_kategori = SubKategori::where('nama','Esai')->value('id_subkategori');
        $postingan = Postingan::where('subKategori_id', $sub_kategori)->get();
        $title = "Esai";
        return view('main.postingan', compact('postingan','title'));
    }

    public function read($id) {
        $postingan = Postingan::where('id_postingan', $id)->first();
        return view('main.read', compact('postingan'));
    }
}
