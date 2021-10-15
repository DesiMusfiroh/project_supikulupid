<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postingan;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\Log;
use Illuminate\Support\Facades\Storage;
use Auth;

class AdminPostinganController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function indexAdmin()
    {
        $postingan = Postingan::where('user_id' , Auth::id())->get();
        
        return view('admin.postingan.index', compact('postingan'));
    }

    public function dataTulisan()
    {
        $data = Postingan::all();
        
        return view('admin.data_tulisan.index', compact('data'));
    }

    public function createAdmin(Request $request) {

        $kategori = Kategori::all();
        
        return view('admin.postingan.create',compact('kategori'));
    }

    public function subCat(Request $request)
    {
         
        $kategori_id = $request->kategori_id;
         
        $subcategories = SubKategori::where('kategori_id',$kategori_id)->get();

        $res = "";
        foreach($subcategories as $item) {
            $res .= '<option value="'. $item->id_subkategori . '">'. $item->nama .'</option>' ;
        }

        return $res;
    }

    public function storeAdmin(Request $request) {
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
            'subKategori_id' => $request->subKategori_id,
            'isi' => $request->isi,
            'gambar' => $nama_file,
            'status' => 'edited',
            'published_at' => null
        ]);
        return redirect()->route('adminPostingan')->with('success','Postingan baru berhasil disimpan !');
    }

    public function showAdmin($id) {
        $postingan = Postingan::findOrFail($id);
        $kategori = Kategori::all();
        $sub_kategori = SubKategori::all();
        return view('admin.postingan.edit', compact('postingan','kategori','sub_kategori'));
    }

    public function updateAdmin(Request $request) {
        // dd($request->id);
        $postingan = Postingan::findOrFail($request->id);
        $postingan->update($request->all());
        return redirect()->route('adminPostingan')->with('success','Berhasil menyimpan perubahan!');
    }

    public function deleteAdmin(Request $request)
    {
        // dd($request->id_postingan);
        $postingan = Postingan::findOrFail($request->id);
        // dd($postingan);
		$postingan->delete();
		return redirect()->back()->with('error','Postingan berhasil di hapus!');
    }

    public function sendAdmin($id) {
        $postingan = Postingan::findOrFail($id);
        $postingan->update([
            'status' => 'processed',
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

    public function publishAdmin($id) {
        $postingan = Postingan::findOrFail($id);
        $postingan->update([
            'status' => 'published',
        ]);
        
        Log::create([
            'user_id' => Auth::user()->id,
            'postingan_id' => $id,
            'judul' => $postingan->judul,
            'status' => 'approved',
            'pesan' => '',
        ]);
        return redirect()->back()->with('success','Admin telah menyetujui postingan !!!');
    }

    public function rejectPostingan($id) {
        $postingan = Postingan::findOrFail($id);
        $postingan->update([
            'status' => 'edited',
        ]);
        
        Log::create([
            'user_id' => Auth::user()->id,
            'postingan_id' => $id,
            'judul' => $postingan->judul,
            'status' => 'rejected',
            'pesan' => ' ',
        ]);
        return redirect()->back()->with('error','Admin telah menolak suatu postingan !!!');
    }
}
