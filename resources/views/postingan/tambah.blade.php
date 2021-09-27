<?php
    use App\Models\SubKategori;
    use App\Models\Kategori;
?>
@extends('template.admin')

@section('header')

@stop

@section('content')
<div class="card p-4">
    <div class="card-header">
        <h4>Tambah Postingan</h4>
      
    </div>
    <div class="bady-body">
        <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Kategori Tulisan</label>
                <select class="form-control" aria-label=".form-select-sm example" name="kategori_id">
                <option selected>Pilih Kategori</option>
                @foreach($kategori as $kat)
                    <option value="{{$kat->id_kategori}}">{{$kat->nama}}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Sub Kategori</label>
                <select class="form-control" aria-label=".form-select-sm example" name="kategori_id">
                <option selected>Pilih Kategori</option>
                @if(SubKategori::where('kategori_id', Kategori::get('id_kategori')) !=  null )
                @foreach($subKategori as $subkat)
                    
                    <option value="{{$subkat->id_subkategori}}">{{$subkat->nama}}</option>
                @endforeach
                @endif
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Judul :</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Judul " name="judul">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Isi :</label>
                <div id="editor">
                    
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary" style="float:right">Simpan</button>
        </form>
    </div>
</div>




@stop

@section('footer')
<script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
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