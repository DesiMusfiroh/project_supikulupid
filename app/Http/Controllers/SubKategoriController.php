<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubKategori;
use App\Models\Kategori;
use Alert;

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

        Alert::success("Berhasil !", "Sub Kategori $subKategori->nama berhasil disimpan!");
        return redirect()->back();
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
        Alert::success("Berhasil !", "Sub Kategori $subKategori_nama berhasil diupdate!");
        return redirect()->back();
    }

    public function destroy($id)
    {
        $subKategori = SubKategori::where('id_subkategori',$id)->first();
        $subKategori->delete();
        Alert::success("Sub Kategori dihapus !", "Sub Kategori $subKategori->nama telah dihapus!");
        return redirect()->back();
    }
}
