@extends('layouts.admin.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Edit Postingan </h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="/postingan_penulis">Postingan</a></div>
            <div class="breadcrumb-item">Edit</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <form action="{{route('postingan.store')}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label>Kategori Tulisan</label>
                            <select class="form-control" aria-label=".form-select-sm example" name="kategori_id">
                            <option selected>Pilih Kategori</option>
                            @foreach($kategori as $item)
                                <option value="{{$item->id_kategori}}">{{$item->nama}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label>Sub Kategori Tulisan</label>
                            <select class="form-control" aria-label=".form-select-sm example" name="subkategori_id">
                            <option selected>Pilih Kategori</option>
                            @if(SubKategori::where('kategori_id', Kategori::get('id_kategori')) !=  null )
                            @foreach($sub_kategori as $item)
                                <option value="{{$item->id_subkategori}}">{{$item->nama}}</option>
                            @endforeach
                            @endif
                            </select>
                        </div>
                        <div class="col">
                            <label>Foto Sampul Tulisan</label>
                            <input type="file" id="gambar" name="gambar" aria-describedby="inputGroupFileAddon04">
                        </div>
                    </div>
                   
                    <div class="form-group row mt-3">
                        <label for="judul" class="col-md-2 col-form-label">Judul Tulisan</label>
                        <div class="col">
                        <input type="text" class="form-control" id="judul" value="{{$postingan->judul}}" placeholder="Masukkan Judul Tulisan " name="judul">
                        </div>
                    </div>
            
                    <div class="form-group">
                        <label>Isi Konten</label>
                        <textarea class="form-control" type="text" id="ckeditor" name="isi" value="{!!$postingan->isi!!}"></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary" style="float:right">Simpan Perubahan</button>
                </form>
            </div>
           
        </div>
    </div>

</section>

<script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'ckeditor' );
</script>
@stop

