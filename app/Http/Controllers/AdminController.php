<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;

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

    public function logs() {
        $logs = Log::all();
        return view('admin.logs.index',compact('logs'));
    }

}
