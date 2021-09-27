@extends('layouts.penulis')

@section('breadcrumb')
    <h3 class="text-themecolor">Profil Penulis</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item active">Edit Profil</li>
    </ol>
@endsection

@section('content')
<div class="card p-4">
    <div class="bady-header">
        <h4>Profil Saya</h4>
    </div>
    <div class="bady-body">
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

@stop

@section('footer')
<script src="https://cdn.ckeditor.com/ckeditor5/29.2.0/classic/ckeditor.js"></script>
<script>
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
</script>

@stop