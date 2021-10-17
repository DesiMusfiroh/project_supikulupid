@extends('layouts.admin.master')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Kategori</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
            <div class="breadcrumb-item">Kategori</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-md-9">
                <div class="card table-inside">
                    <table class="table table-striped" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th width="15px">No</th>
                                <th>Nama Kategori</th>
                                <th class="text-right">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($kategori as $no => $value)
                            <tr>
                                <td>{{++$no}}</td>
                                <td>{{$value->nama}}</td>
                                <td class="text-right">
                                <button href="#" class="btn btn-warning edit-kategori" 
                                    data-kategori_id="{{$value->id_kategori}}" 
                                    data-nama_kategori="{{$value->nama}}" 
                                    data-toggle="modal" data-target="#edit_kategori">
                                        Edit
                                </button>    
                                <a href="/kategori/{{$value->id_kategori}}"  class="btn btn-danger">Hapus</a>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-3">
                <div class="card card-primary">
                    <div class="card-header"><h4>Tambah Kategori</h4></div>
                    <div class="card-body">
                        <div class="text-center">
                            <button href="#" class='btn btn-success' data-toggle="modal" data-target="#modalForm"> <i class="fa fa-plus mr-2"></i> Tambah</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</section>

<!-- modal-tambah  -->
<div class="modal fade modal-show" id="modalForm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Kategori</h5>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="{{route('kategori.store')}}" method="post" >
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

<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

<script>
    $('#btn-tambah').on('click',function(){
            $.ajax({
                method: "GET",
                success: function(data){
                    $('#modal-show').modal('show')
                },
                error:function(error){
                    console.log(error)
                }
            })
        })

        $('.btn-edit').on('click',function(){
            let id = $(this).data('id')
            $.ajax({
                url:`/edit/${id}/kategori`,
                method: `GET`,
                success: function(data){
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
        var nama_kategori = $(this).data('nama_kategori')
        var kategori_id   = $(this).data('kategori_id');
        $("#kategori_id_update").val(kategori_id);
        $("#nama_kategori_update").val(nama_kategori);
        });
    });
</script>

<!-- Modal EDIT -->
<div class="modal fade"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" id="edit_kategori">
    <div class="modal-dialog modal-lg-12" >
      <div class="modal-content">
        <div class="modal-header ">
          <h5 class="modal-title " id="exampleModalLabel"> Edit Kategori</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('kategori.update')}}" enctype="multipart/form-data" method="post">
          @csrf @method('PATCH')
            <div class="modal-body">
              <div class="col-md-12">
                    <div class="form-group">
                      <label for="nama_pakar" class="col-form-label">Nama Kategori</label>
                      <input type="hidden" value="" name="id_kategori" id="kategori_id_update">
                      
                      <input class="form-control" type="text" name="nama" id="nama_kategori_update" value="">
                    </div>
              </div>
            </div>

          <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="submit" class="btn btn-primary" >Simpan Perubahan</button>
          </div>
        </form>
      </div>
    </div>
</div>

@stop

