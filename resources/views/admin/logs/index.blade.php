@extends('layouts.admin.master')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Semua Aktivitas</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
            <div class="breadcrumb-item">Aktivitas</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card">
        
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Judul Postingan</th>
                        <th class="text-center">Pesan Admin</th>
                        <th class="text-center">Tanggal Kirim</th>
                        <th class="text-center">Tanggal Aksi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($logs as $no => $value)
                        <tr>
                            <td class="text-center">{{$no+1}}</td>
                            <td class="text-center">{{$value->status}}</td>
                            <td>{{$value->judul}}</td>
                            <td>{{$value->pesan}}</td>
                            <td class="text-center">{{$value->created_at}}</td>
                            <td class="text-center">@if ($value->created_at != $value->updated_at) {{$value->updated_at}} @else - @endif</td>
                            <td>
                                <button type="button" class="btn btn-success"><i class="fa fa-eye"> </i></button>
                                <button class="btn btn-primary btn-action" data-toggle="modal" data-target=".aksi_modal"
                                    id="aksi"
                                    data-id_postingan="{{ $value->id }}"
                                    data-judul_postingan="{{ $value->judul }}">
                                    <i class="fa fa-edit"></i>                                       
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>  
        </div>
    </div>
</section>

<!-- Aksi Modal -->
<div class="modal fade aksi_modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title " id="exampleModalLabel">Aksi</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="" method="post">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="id" value="" id="id_postingan" >
                <p>Postingan : <b> <span id="judul_postingan"></span> </b></p>     
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-danger">Tolak </button>
                <button type="submit" class="btn btn-success">Terbitkan Postingan</button>
            </div>
        </form>
        </div>
    </div>
</div>

<!-- Penutup Aksi Modal -->

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
$(document).ready(function(){
    $(document).on('click','#delete', function(){
        var id_postingan   = $(this).data('id_postingan');   
        var judul_postingan = $(this).data('judul_postingan');   
        $('#id_postingan').val(id_postingan);
        $('#judul_postingan').text(judul_postingan);
    });     
});
</script>
@stop
