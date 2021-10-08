<?php
    use App\Models\Postingan;
?>
@extends('layouts.admin.master')

@section('breadcrumb')
    <h3 class="text-themecolor">Daftar Postingan</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item active">Postingan</li>
    </ol>
@endsection

@section('content')
<div class="card p-4">
   
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

    <div class="card-header">
        <h4>Daftar Postingan</h4>
        <a href="{{route('postingan.create')}}" class="btn btn-success" style="float:right"> <i class="fa fa-plus mr-2 "></i> Tambah</a>
    </div>
    <div class="bady-body">
        <table class="table table-striped table-bordered" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Kategori</th>
                    <th class="text-center">Sub Kategori</th>
                    <th class="text-center">Judul</th>
                    <th class="text-center">Status</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
               @foreach($postingan as $no => $value)
                    <tr>
                        <td class="text-center">{{$no+1}}</td>
                        <td>{{$value->kategori->nama}}</td>
                        <td>{{$value->sub_kategori->nama}}</td>
                        <td>{{$value->judul}}</td>
                        <td>{{$value->status}}</td>
                        <td class="text-right">
                            @if ($value->status == 'edited')
                                <a href="{{route('sendPostingan', $value->id_postingan)}}" >
                                    <button class="btn btn-info btn-action"><i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                                </a>     
                            @endif  
                            <a href="{{route('postingan.show', $value->id_postingan)}}">
                                <button class="btn btn-warning btn-action"> <i class="fa fa-edit"></i> </button>
                            </a>                    
                            <button class="btn btn-danger btn-action" data-toggle="modal" data-target=".delete_modal"
                                id="delete"
                                data-id_delete="{{ $value->id }}"
                                data-judul_delete="{{ $value->judul }}">
                                <i class="fa fa-trash"></i>                                       
                            </button>
                        </td>
                    </tr>
               @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade delete_modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title " id="exampleModalLabel">Hapus Postingan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('postingan.delete')}}" method="post">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="id" value="" id="id_delete" >
                <p>Postingan : <b> <span id="judul_delete"></span> </b> akan di hapus </p>     
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Hapus Postingan</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Penutup Delete Modal -->

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
$(document).ready(function(){
    $(document).on('click','#delete', function(){
        var id_delete   = $(this).data('id_delete');   
        var judul_delete = $(this).data('judul_delete');   
        $('#id_delete').val(id_delete);
        $('#judul_delete').text(judul_delete);
    });     
});
</script>
@stop
