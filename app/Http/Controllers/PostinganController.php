<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postingan;
use App\Models\User;
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
        $postingan = Postingan::where('user_id', '!=', Auth::user()->id)->where('status',['published','processed'])->get();
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

    public function adminUpdate(Request $request) {
        $postingan = Postingan::findOrFail($request->id);
        $postingan->update($request->all());
        Alert::success("Berhasil !", "Perubahan berhasil disimpan !");
        return redirect()->route('postingan.admin');
    }

    public function adminPublish($id) {
        $postingan = Postingan::findOrFail($id);
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $postingan->update([
            'status' => 'published',
            'published_at' => $date
        ]);
        Alert::success("Postingan di publish !", "Postingan $postingan->judul telah di berhasil di publish !");
        return redirect()->back();
    }

    public function detail($id) {
        $postingan = Postingan::findOrFail($id);
        $user = User::where('id', $postingan->user_id)->first();
        return view('admin.postingan.detail', compact('postingan', 'user'));
    }

    public function publish(Request $request) {
        $postingan = Postingan::findOrFail($request->id_publish);
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $postingan->update([
            'status' => 'published',
            'published_at' => $date
        ]);
        $pesan = $request->pesan;
        if ($request->pesan == null) {
            $pesan = "";
        }
        $log = Log::where('postingan_id', $postingan->id_postingan)->orderBy('created_at','DESC')->first();
        $log->update([
            'status' => 'approved',
            'pesan' => $pesan,
        ]);
        Alert::success("Postingan di publish !", "Postingan $postingan->judul telah di berhasil di publish !");
        return redirect()->back();
    }

    public function reject(Request $request) {
        $postingan = Postingan::findOrFail($request->id_reject);
        $date = Carbon::now()->format('Y-m-d H:i:s');
        $postingan->update([
            'status' => 'edited',
        ]);
        $log = Log::where('postingan_id', $postingan->id_postingan)->orderBy('created_at','DESC')->first();
        $log->update([
            'status' => 'rejected',
            'pesan' => $request->pesan,
        ]);
        Alert::success("Postingan di reject !", "Postingan $postingan->judul telah di reject !");
        return redirect()->back();
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
