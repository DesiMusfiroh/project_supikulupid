@extends('layouts.penulis.master')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Edit Profil Penulis</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
            <div class="breadcrumb-item">Edit Profil</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <form action="{{route('profil.update')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="id_penulis" value="{{$penulis->id_penulis}}">
                            <div class="form-group row mt-3">
                                <label for="nama" class="col-md-2 col-form-label">Nama Penulis</label>
                                <div class="col">
                                <input type="text" class="form-control" id="nama" name="nama" value="{{$penulis->nama}}">
                                </div>
                            </div>
                    
                            <div class="form-group">
                                <label>Tentang Saya</label>
                                <textarea class="form-control" type="text" id="editor" name="tentang">{{$penulis->tentang}}</textarea>
                            </div>
                            
                            <button type="submit" class="btn btn-primary" style="float:right">Simpan Perubahan</button>
                        </form>
                    </div>   
                </div>
            </div>

            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        @if ($penulis->image == null) 
                            <img alt="image" width="100%" src="../assets/img/avatar/avatar-1.png" class="rounded-circle author-box-picture">
                        @else
                            <img width="100%" src="../images/{{$penulis->image}}"  />
                        @endif
                        <form action="{{route('profil.update.image')}}"  method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" value="{{$penulis->id_penulis}}" name="id_penulis" />
                            <input type="file" id="image" name="image" aria-describedby="image" class="mt-2 mb-2" required>
                            <button type="submit" class="btn btn-success"> Simpan Foto Profil </button>
                        </form>
                    </div>
                </div>
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