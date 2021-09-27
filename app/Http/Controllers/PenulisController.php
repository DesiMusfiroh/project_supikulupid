<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postingan;
use App\Models\Kategori;
use App\Models\SubKategori;
use App\Models\Log;
use App\Models\Penulis;
use Illuminate\Support\Facades\Storage;
use Auth;

class PenulisController extends Controller
{
    public function postingan() {
        $postingan = Postingan::where('user_id','=', Auth::user()->id)->get();
        return view('penulis.postingan.index',compact('postingan'));
    }

    public function logs() {
        $logs = Log::where('user_id','=', Auth::user()->id)->get();
        return view('penulis.logs.index',compact('logs'));
    }

    public function profil() {
        $penulis = Penulis::where('user_id','=', Auth::user()->id)->first();
        return view('penulis.profil.index',compact('penulis'));
    }

    public function updateProfil(Request $request) {
        $penulis = Penulis::findOrFail($request->id_penulis);
        $penulis->update($request->all());
        return redirect()->back()->with('success','Perubahan profil berhasil disimpan!');
    }
}
