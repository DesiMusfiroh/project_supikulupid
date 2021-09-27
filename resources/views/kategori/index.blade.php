@extends('template.admin')

@section('header')

@stop

@section('content')
<div class="card p-4">
    <div class="card-header">
        <h4>Daftar Kategori</h4>
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
                    <th>Nama Kategori</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kategori as $no => $value)
                <tr>
                    <td>{{++$no}}</td>
                    <td>{{$value->nama}}</td>
                    <td>
                    <a href="#" class="btn btn-warning py-2 px-3 active edit-kategori" 
                        data-kategori_id="{{$value->id_kategori}}" 
                        data-nama_kategori="{{$value->nama}}" 
                        data-toggle="modal" data-target="#edit_kategori">
                             Edit
                    </a>    
                    <a href="/kategori/{{$value->id_kategori}}"  class="btn btn-danger">Hapus</a>
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
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('tambahKategori')}}" method="post" >
      @csrf
      @method('POST')
      <div class="modal-body">
            <div class="form-group">
                <label for="exampleInputEmail1">Nama Kategori</label>
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

        $('.btn-edit').on('click',function(){
            // console.log($(this).data('id'))
            let id = $(this).data('id')
            $.ajax({
                url:`/edit/${id}/kategori`,
                method: `GET`,
                success: function(data){
                    // console.log(data)
                    // $('#modal-edit').find('.modal-body').html(data)
                    $('#modal-edit').modal('show')
                },
                error:function(error){
                    console.log(error)
                }
            })
        })
</script>

<script>
    $(document).ready(function () {
        $(".edit-kategori").click(function (e) {
        var nama_kategori     = $(this).data('nama_kategori')
        var kategori_id          = $(this).data('kategori_id');
        

        $("#kategori_id_update").val(kategori_id);
        $("#nama_kategori_update").val(nama_kategori);
        });
    });
</script>

<!-- Modal EDIT PENYAKIT -->
<div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="edit_kategori">
    <div class="modal-dialog modal-lg-12" >
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title " id="exampleModalLabel"> Edit Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('updateKategori')}}" enctype="multipart/form-data" method="post">
          @csrf @method('PATCH')
            <div class="modal-body">
              <div class="container">
              <div class="col-md-12">
                    <div class="form-group">
                      <label for="nama_pakar" class="col-form-label">Nama Kategori</label>
                      <input type="hidden" value="" name="id_kategori" id="kategori_id_update">
                      
                      <input class="form-control" type="text" name="nama" id="nama_kategori_update" value="">
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