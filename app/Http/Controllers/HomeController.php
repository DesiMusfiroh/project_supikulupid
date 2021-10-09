<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postingan;
use App\Models\Penulis;
use App\Models\Log;
use App\Models\User;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->role == 'admin'){
            $postingan_processed = Postingan::where('status','=','processed')->get();
            return view('admin.index', compact('postingan_processed'));
        } else if (Auth::user()->role == 'penulis'){
            $user = User::where('id', Auth::user()->id)->first();

            return view('penulis.index', compact('user'));
        }
    }
}
