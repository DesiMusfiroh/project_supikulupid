<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postingan;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\Log;
use Illuminate\Support\Facades\Storage;
use Auth;

class PostinganController extends Controller
{
    // manage postingan penulis
    public function create() {
        $kategori = Kategori::all();
        $sub_kategori = SubKategori::all();
        return view('penulis.postingan.create',compact('kategori','sub_kategori'));
    }

    public function store(Request $request) {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required', 
            'isi' => 'required',
            'gambar' => 'required|file|image|mimes:png,jpg,jpeg',
        ]);
  
        $file = $request->file('gambar');
        $nama_file = time()."_".$file->getClientOriginalName();
        $upload = Storage::putFileAs('public/images',$request->file('gambar'),$nama_file);

        $postingan = Postingan::create([
            'judul' => $request->judul,
            'user_id' => Auth::user()->id,
            'kategori_id' => $request->kategori_id,
            'subKategori_id' => $request->subkategori_id,
            'isi' => $request->isi,
            'gambar' => $nama_file,
            'status' => 'edited',
            'published_at' => null
        ]);
        return redirect()->route('postingan.penulis')->with('success','Postingan baru berhasil disimpan !');
    }

    public function show($id) {
        $postingan = Postingan::findOrFail($id);
        $kategori = Kategori::all();
        $sub_kategori = SubKategori::all();
        return view('penulis.postingan.edit', compact('postingan','kategori','sub_kategori'));
    }

    public function update(Request $request) {
        $postingan = Postingan::findOrFail($request->id);
        $postingan->update($request->all());
        return redirect()->back()->with('success','Berhasil menyimpan perubahan!');
    }

    public function delete(Request $request)
    {
        $postingan = Postingan::findOrFail($request->id);
        dd($postingan);
		$postingan->delete();
		return redirect()->back()->with('success','Postingan berhasil di hapus!');
    }
    
    public function send($id) {
        $postingan = Postingan::findOrFail($id);
        $postingan->update([
            'status' => 'sent',
        ]);
        Log::create([
            'user_id' => Auth::user()->id,
            'postingan_id' => $id,
            'judul' => $postingan->judul,
            'status' => 'pending',
            'pesan' => '',
        ]);
        return redirect()->back()->with('success','Postingan anda berhasil dikirim, mohon menunggu persetujuan admin!');
    }
}
