<?php
    use App\Models\SubKategori;
    use App\Models\Kategori;
?>
@extends('layouts.admin.master')

@section('breadcrumb')
    <h3 class="text-themecolor">Buat Postingan Baru</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item">Postingan</li>
        <li class="breadcrumb-item active">Tambah</li>
    </ol>
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Buat Postingan Baru</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="/postingan_penulis">Postingan</a></div>
            <div class="breadcrumb-item">Tambah Baru</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <div class="card-body">
                <form action="{{route('storePostingan')}}" method="post"  enctype="multipart/form-data" id='form1'>
                    @csrf
                    <div class="row">
                        <div class="col-4">
                            <label>Kategori Tulisan</label>
                            <select class="form-control" aria-label=".form-select-sm example" name="kategori_id" id="category">
                            <option selected>Pilih Kategori</option>
                            @foreach($kategori as $item)
                                <option value="{{$item->id_kategori}}">{{$item->nama}}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col-4">
                            <label>SubKategori Tulisan</label>
                            <select class="browser-default custom-select" name="subKategori_id" id="subcategory"></select>
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
    </div>

</section>

<script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'ckeditor' );
</script>

<script type="text/javascript">

$(document).ready(function () {
    $('#category').on('change',function(e) {
        // console.log(e);
        var kategori_id = e.target.value;
        $.ajax({
            url:`{{ route('createSubKategori') }}`,
            type:"POST",
            data: {
            kategori_id: kategori_id,
            "_token": "{{ csrf_token() }}",
            },
            success:function (data) {
            // console.log(data);
            $('#subcategory').append(data);
            // $.each(data.subcategories[0].subcategories,function(index,subcategory){
            // $('#subcategory').append('<option value="'+subcategory.id_subkategori+'">'+subcategory.nama+'</option>');
            // })
            }
        })
    });
});
</script>

@stop

