<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Alert;

class KategoriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function store(Request $req)
    {
        $nama_kategori = $req->nama;

        $kategori = new Kategori;
        $kategori ->nama = $nama_kategori;
        $kategori->save();

        Alert::success("Berhasil !", "Kategori $kategori->nama berhasil disimpan!");
        return redirect()->back();
    }


    public function update(Request $req)
    {
        $id_kategori = $req->id_kategori;
        $nama_kategori  = $req->nama;
        $kategori = Kategori::where('id_kategori',$id_kategori)->update([
            'nama' => $nama_kategori,
        ]);
        Alert::success("Berhasil !", "Kategori $nama_kategori berhasil diupdate!");
        return redirect()->back()->with("success"," Data Berhasil Di Ubah");
    }

    public function destroy($id)
    {
        $kategori = Kategori::where('id_kategori',$id)->first();
        $kategori->delete();
        Alert::success("Kategori dihapus !", "Kategori $kategori->nama telah dihapus!");
        return redirect()->back()->with("error"," Data Berhasil Di Hapus");
    }
}
