<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postingan;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\Log;
use Illuminate\Support\Facades\Storage;
use Auth;
use Alert;
use Carbon\Carbon;

class PostinganController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $postingan = Postingan::all();
        
        return view('penulis.postingan.index', compact('postingan'));
    }

    
    // manage postingan penulis
    public function create() {

        $kategori = Kategori::pluck("nama","id_kategori");
        return view('penulis.postingan.create',compact('kategori'));

    }

    

   


    public function store(Request $request) {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required', 
            'isi' => 'required',
            'gambar' => 'required|file|image|mimes:png,jpg,jpeg',
        ]);

        $nama_file = time().'.'.$request->gambar->extension();  
        $request->gambar->move(public_path('images'), $nama_file);

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
        Alert::success("Berhasil !", "Postingan : $postingan->judul, berhasil disimpan!");
        return redirect()->route('postingan.penulis');
    }

    public function show($id) {
        $postingan = Postingan::findOrFail($id);
        $kategori = Kategori::pluck("nama","id_kategori");
        return view('penulis.postingan.edit', compact('postingan','kategori'));
    }

    public function update(Request $request) {
        $postingan = Postingan::findOrFail($request->id);
        $postingan->update($request->all());
        Alert::success("Berhasil !", "Perubahan berhasil disimpan!");
        return redirect()->route('postingan.penulis');
    }

    public function delete(Request $request) {
        $postingan = Postingan::findOrFail($request->id_delete);
		$postingan->delete();
        Alert::success("Berhasil", "Postingan $postingan->judul telah dihapus!");
		return redirect()->back();
    }
    
    public function send($id) {
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

    // manage postingan admin
    public function indexAll() {
        $postingan = Postingan::all();
        return view('admin.postingan.all',compact('postingan'));
    }

    public function adminCreate() {
        $kategori = Kategori::pluck("nama","id_kategori");
        return view('admin.postingan.create',compact('kategori'));
    }

    public function adminStore(Request $request) {
        $request->validate([
            'judul' => 'required',
            'kategori_id' => 'required', 
            'isi' => 'required',
            'gambar' => 'required|file|image|mimes:png,jpg,jpeg',
        ]);
  
        $nama_file = time().'.'.$request->gambar->extension();  
        $request->gambar->move(public_path('images'), $nama_file);

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
        return redirect()->route('postingan.admin')->with('success','Postingan baru berhasil disimpan !');
    }

    public function adminEdit($id) {
        $postingan = Postingan::findOrFail($id);
        $kategori = Kategori::pluck("nama","id_kategori");
        return view('admin.postingan.edit', compact('postingan','kategori'));
    }

    public function publish($id) {
        $postingan = Postingan::findOrFail($id);
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $postingan->update([
            'status' => 'published',
            'published_at' => $date,
        ]);
        return redirect()->back()->with('success','Postingan anda berhasil dipublish!');
    }


    // controller ajax 
    public function getSubKategori($id)  {
        $subkategori = SubKategori::where("kategori_id",$id)->pluck("nama","id_subkategori");
        return json_encode($subkategori);
    }

    public function uploadImageEditor(Request $request) {    
        if($request->hasFile('upload')) {
            $originName = $request->file('upload')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('upload')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
        
            $request->file('upload')->move(public_path('images'), $fileName);
    
            $CKEditorFuncNum = $request->input('CKEditorFuncNum');
            $url = asset('images/'.$fileName); 
            $msg = 'Image uploaded successfully'; 
            $response = "<script>window.parent.CKEDITOR.tools.callFunction($CKEditorFuncNum, '$url', '$msg')</script>";
                
            @header('Content-type: text/html; charset=utf-8'); 
            echo $response;
        }
    }  
}
