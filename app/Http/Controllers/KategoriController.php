<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $kategori = Kategori::all();
        return view('kategori.index', compact('kategori'));
    }

    public function store(Request $req)
    {
        $nama_kategori = $req->nama;

        $kategori = new Kategori;
        $kategori ->nama = $nama_kategori;
        $kategori->save();

        return redirect('kategori');
    }


    public function update(Request $req)
    {
        $id_kategori = $req->id_kategori;
        $nama_kategori  = $req->nama;

        $kategori = Kategori::where('id_kategori',$id_kategori)->update([
            'nama' => $nama_kategori,
        ]);

        return redirect()->back()->with("success"," Data Berhasil Di Ubah");
    }

    public function destroy($id)
    {
        $kategori = Kategori::where('id_kategori',$id)->delete();

        return redirect()->back()->with("error"," Data Berhasil Di Hapus");
    }
}
