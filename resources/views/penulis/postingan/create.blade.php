<?php
    use App\Models\SubKategori;
    use App\Models\Kategori;
?>
@extends('layouts.penulis')

@section('breadcrumb')
    <h3 class="text-themecolor">Buat Postingan Baru</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item">Postingan</li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
@endsection

@section('content')
<div class="card p-4">
    <div class="bady-body">
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
                <input type="text" class="form-control" id="judul"  placeholder="Masukkan Judul Tulisan " name="judul">
                </div>
            </div>
    
            <div class="form-group">
                <label>Isi Konten</label>
                <textarea class="form-control" type="text" id="ckeditor" name="isi"></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary" style="float:right">Simpan</button>
        </form>
    </div>
</div>

@stop

@section('footer')
<script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'ckeditor' );
</script>
<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script src="//cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
<!-- <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
<script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('#tabel-data').DataTable();
    });
</script>

@stop