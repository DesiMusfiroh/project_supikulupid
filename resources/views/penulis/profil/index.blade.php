@extends('layouts.penulis.master')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Edit Profil Penulis</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
            <div class="breadcrumb-item"><a href="/profil">Profil</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">
    <div class="card">
        <div class="card-body">
            <form action="{{route('profil.update')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <input type="hidden" name="id_penulis" value="{{$penulis->id_penulis}}">
                <div class="form-group row mt-3">
                    <label for="nama" class="col-md-2 col-form-label">Nama Lengkap</label>
                    <div class="col">
                    <input type="text" class="form-control" id="nama" name="nama" value="{{$penulis->nama}}">
                    </div>
                </div>
        
                <div class="form-group">
                    <label>Tentang Saya</label>
                    <textarea class="form-control" type="text" id="editor" name="tentang" value="{{$penulis->tentang}}"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary" style="float:right">Simpan Perubahan</button>
            </form>
        </div>
        
    </div>
    </div>
</section>

<script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

@stop