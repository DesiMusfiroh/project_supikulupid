<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubKategori;
use App\Models\Kategori;

class SubKategoriController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $subKategori = SubKategori::all();
        $kategori = Kategori::all();
        return view('admin.subKategori.index', compact('subKategori','kategori'));
    }

    public function store(Request $request)
    {
        $id_kategori = $request->kategori_id;
        $nama_subKategori = $request->nama;

        $subKategori = new SubKategori;
        $subKategori ->kategori_id = $id_kategori;
        $subKategori -> nama = $nama_subKategori;
        $subKategori->save();

        return redirect()->back()->with('success','Data Berhasil Di Simpan');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        
    }

    public function update(Request $request)
    {
        $kategori_id = $request->kategori_id;
        $subKategori_nama = $request->nama;
        $subKategori_id = $request->id_subkategori;

        $subKategori = SubKategori::where('id_subkategori',$subKategori_id)->update([
            'kategori_id' => $kategori_id,
            'nama'=> $subKategori_nama,
        ]);

        return redirect()->back()->with('success','Data Berhasil Diubah');
    }

    public function destroy($id)
    {
        $subKategori = SubKategori::where('id_subkategori',$id)->delete();

        return redirect()->back()->with('error','Data Baerhasil Di Hapus');
    }
}
