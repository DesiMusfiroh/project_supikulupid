@extends('layouts.penulis.master')

@section('content')
<section class="section">
    <div class="section-header">
        <a href="{{route('postingan.create')}}" class="btn btn-success mr-3"> <i class="fa fa-plus mr-2 "></i> Tambah </a>
        <h1>Postingan</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
            <div class="breadcrumb-item">Postingan</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
            <table  class="table table-striped" width="100%" cellspacing="0">
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
                            <td> 
                                @if ($value->status == 'edited')
                                <div class="badge badge-pill badge-warning mb-1 float-right">{{$value->status}}</div> 
                                @elseif ($value->status == 'published')
                                <div class="badge badge-pill badge-success mb-1 float-right">{{$value->status}}</div>
                                @else 
                                <div class="badge badge-pill badge-primary mb-1 float-right">{{$value->status}}</div>
                                @endif
                            </td>
                            <td class="text-right">
                                @if ($value->status == 'edited')
                                    <a href="{{route('postingan.send', $value->id_postingan)}}" >
                                        <button class="btn btn-info btn-action btn-sm"> <i class="fa fa-send"></i> Kirim </button>
                                    </a>     
                                @endif  
                                <a href="{{route('postingan.show', $value->id_postingan)}}">
                                    <button class="btn btn-warning btn-action  btn-sm"> <i class="fa fa-edit"></i> </button>
                                </a>                    
                                <button class="btn btn-danger btn-action  btn-sm" data-toggle="modal" data-target=".delete_modal"
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
