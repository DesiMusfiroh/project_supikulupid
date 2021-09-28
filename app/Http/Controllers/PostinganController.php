<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Postingan;
use App\Models\Kategori;
use App\Models\SubKategori;

class PostinganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $postingan = Postingan::all();
        $kategori = Kategori::all();
        $subKategori = SubKategori::all();
        return view('postingan.index',compact('postingan','kategori','subKategori'));
    }

    public function create()
    {
        $postingan = Postingan::all();
        $kategori = Kategori::all();
        $subKategori = SubKategori::all();
        return view('postingan.tambah',compact('postingan','kategori','subKategori'));
    }

    public function subKategori($id)
    {
        
    }
    
    public function store(Request $request)
    {
        //
    }

    
    public function show($id)
    {
        //
    }

    
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    
    public function destroy($id)
    {
        //
    }
}
