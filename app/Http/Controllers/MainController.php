<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postingan;
use App\Models\Kategori;
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
        $kategori_berita_id = Kategori::where('nama','Berita')->value('id_kategori');
        $berita = Postingan::where('kategori_id', $kategori_berita_id)->get();
        return view('main.berita', compact('berita'));
    }

    public function read($id) {
        $postingan = Postingan::where('id_postingan', $id)->first();
        return view('main.read', compact('postingan'));
    }
}
