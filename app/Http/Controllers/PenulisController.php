<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
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
    public function __construct()
    {
        $this->middleware('auth');
    }
   
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

    public function pengaturan()
    {
        return view('penulis.settings');
    } 
   
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        return redirect()->route('home')->with('success','Password berhasil diganti!');
    }

    public function getNotification() {
        $logs = Log::where('user_id','=', Auth::user()->id)->where('status','=','pending')->get();
        return json_encode($logs);
    }
}
