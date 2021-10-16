<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Log;
use App\Models\Postingan;
use Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('admin.index');
    }

    public function postingan() {
        $postingan = Postingan::where('user_id','=', Auth::user()->id)->get();
        return view('admin.postingan.index',compact('postingan'));
    }

    public function logs() {
        $logs = Log::all();
        return view('admin.logs.index',compact('logs'));
    }

    public function pengaturan()
    {
        return view('admin.settings');
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
        $logs = Log::where('status','=','pending')->get();
        $array[] = [];
        foreach($logs as $key => $value) {
            $array[++$key] = [$value->id, 
            $value->postingan_id, 
            $value->user->username, 
            $value->judul,
            $value->pesan,
            $value->status,
            $value->created_at,
            $value->updated_at,];
        }
        return json_encode($array);
    }
}
