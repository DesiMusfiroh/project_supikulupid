<?php

namespace App\Http\Controllers;

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

}
