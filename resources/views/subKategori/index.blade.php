@extends('template-admin.template')

@section('header')

@stop

@section('content')
<div class="card p-4">
    <div class="card-header">
        <h4>Daftar Sub Kategori</h4>
        <!-- <form action="#"> -->
            <button type="submit" class="d-block mr-0 ml-auto btn-success " data-toggle="modal" data-target="#modalForm"><i class="fa fa-plus"></i> Tambah</button>
        <!-- </form> -->
        <!-- <a href="#" class="d-block mr-0 ml-auto btn-success btn-tambah"> <i class="fa fa-plus"></i> Tambah</a> -->
    </div>
    @if ($message = Session::get('success'))
      <div class="alert alert-success alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
          <strong>{{ $message }}</strong>
      </div>
    @endif

    @if ($message = Session::get('error'))
      <div class="alert alert-danger alert-block">
        <button type="button" class="close" data-dismiss="alert">×</button>    
        <strong>{{ $message }}</strong>
      </div>
    @endif
    <div class="bady-body">
        <table id="tabel-data" class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kategori</th>
                    <th>Sub Kategori</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($subKategori as $no => $value)
                <tr>
                    <td>{{++$no}}</td>
                    <td>{{$value->kategori->nama}}</td>
                    <td>{{$value->nama}}</td>
                    <td>
                    <a href="#" class="btn btn-warning py-2 px-3 active edit-subkategori" 
                        data-id_subkategori="{{$value->id_subkategori}}" 
                        data-id_kategori="{{$value->kategori_id}}" 
                        data-nama_subkategori="{{$value->nama}}"
                        data-toggle="modal" data-target="#edit_subkategori">
                             Edit
                    </a>    
                    <a href="/subkategori/{{$value->id_subkategori}}"  class="btn btn-danger">Hapus</a>
                    </td>   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- modal-show  -->
<div class="modal fade modal-show" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Sub Kategori</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('tambahSubKategori')}}" method="post" >
      @csrf
      @method('POST')
      <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Kategori</label>
                <select class="form-control" aria-label=".form-select-sm example" name="kategori_id">
                <option selected>Pilih Kategori</option>
                @foreach($kategori as $kat)
                    <option value="{{$kat->id_kategori}}">{{$kat->nama}}</option>
                @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Sub Kategori</label>
                <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" placeholder="Masukkan Nama Kategori">
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-update">Simpan Data</button>
      </div>
      </form>
    </div>
  </div>
</div>



@stop

@section('footer')
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

<script>
    $('#btn-tambah').on('click',function(){
            $.ajax({
                // url:`/tambahKategori`,
                method: "GET",
                success: function(data){
                    // console.log(data)
                    // $('#modal-show').find('.modal-body').html(data)
                    $('#modal-show').modal('show')
                },
                error:function(error){
                    console.log(error)
                }
            })
        })
</script>

<script>
    $(document).ready(function () {
        $(".edit-subkategori").click(function (e) {
        var nama_subkategori     = $(this).data('nama_subkategori')
        var id_subkategori          = $(this).data('id_subkategori');
        var id_kategori         =$(this).data('id_kategori')
        

        $("#subkategori_id_update").val(id_subkategori);
        $("#nama_subkategori_update").val(nama_subkategori);
        $('#kategori_id_update').val(id_kategori);
        });
    });
</script>

<!-- Modal EDIT PENYAKIT -->
<div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="edit_subkategori">
    <div class="modal-dialog modal-lg-12" >
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title " id="exampleModalLabel"> Edit Pakar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('updateSubKategori')}}" enctype="multipart/form-data" method="post">
          @csrf @method('PATCH')
            <div class="modal-body">
              <div class="container">
              <div class="col-md-12">
              <input type="hidden" value="" name="id_subkategori" id="subkategori_id_update">

                    <div class="form-group">
                      <label for="nama_pakar" class="col-form-label">Kategori</label>
                      <!-- <input class="form-control" type="text" name="nama" id="kategori_id_update" value=""> -->
                      <select class="form-control" aria-label=".form-select-sm example" name="kategori_id">
                        <!-- <option selected id="kategori_id_update" value=""></option> -->
                        @foreach($kategori as $kat)
                            <option value="{{$kat->id_kategori}}">{{$kat->nama}}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                      <label for="nama" class="col-form-label">Sub Kategori</label>
                      <input class="form-control" type="text" name="nama" id="nama_subkategori_update" value="">
                    </div>
              </div>
            </div>


          <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-info btn-sm" >Simpan</button>
          </div>
        </form>
      </div>
    </div>
</div>
@stop