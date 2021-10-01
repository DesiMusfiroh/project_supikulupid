
@extends('layouts.penulis.master')

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
                <form action="{{route('postingan.store')}}" method="post"  enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <label>Kategori Tulisan</label>
                            <select class="form-control" aria-label=".form-select-sm example" name="kategori_id">
                            <option selected>Pilih Kategori</option>
                            @foreach ($kategori as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                            </select>
                        </div>
                        <div class="col">
                            <label>Sub Kategori Tulisan</label>
                            <select class="form-control" aria-label=".form-select-sm example" name="subkategori_id" >
                            <option>Pilih Sub Kategori</option>
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
    </div>

</section>

<script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
<script>
     CKEDITOR.replace('ckeditor', {
        filebrowserUploadUrl: "{{route('upload.image', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
<script type="text/javascript">
    jQuery(document).ready(function () {
        jQuery('select[name="kategori_id"]').on('change',function(){
            var kategoriID = jQuery(this).val();
            if(kategoriID) {
                jQuery.ajax({
                    url : 'create/getsubkategori/' + kategoriID,
                    type : "GET",
                    dataType : "json",
                    success: function(data){
                        console.log("data ===" +data);
                        jQuery('select[name="subkategori_id"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="subkategori_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                    }
                });
            }
            else {
                $('select[name="subkategori_id"]').empty();
            }
        });
    });
</script>
@stop

