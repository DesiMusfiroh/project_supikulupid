@extends('layouts.admin.master')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Postingan Penulis</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
            <div class="breadcrumb-item">Postingan Penulis</div>
        </div>
    </div>

    <div class="section-body">
      <div class="card">
        <div class="table-inside table-responsive">
            <table class='table table-condensed table-hover'>
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
                            <td> @if ($value->sub_kategori != null) {{$value->sub_kategori->nama}} @endif</td>
                            <td>{{$value->judul}}</td>
                            <td> 
                                @if ($value->status == 'published')
                                <div class="badge badge-pill badge-success mb-1 float-right">{{$value->status}}</div>
                                @else 
                                <div class="badge badge-pill badge-primary mb-1 float-right">{{$value->status}}</div>
                                @endif
                            </td>
                            <td class="text-right">
                                <a  href="{{route('postingan.detail',$value->id_postingan)}}">
                                    <button type="button" class="btn btn-info"><i class="fa fa-eye"></i> </button>
                                </a>

                                @if ($value->status == 'processed')
                                <button class="btn btn-success btn-action btn-sm" data-toggle="modal" data-target=".publish_modal"
                                    id="publish"
                                    data-id_publish="{{ $value->id_postingan }}"
                                    data-judul_publish="{{ $value->judul }}">
                                    <i class="fa fa-check"></i> Publish                                     
                                </button>

                                <button class="btn btn-danger btn-action btn-sm" data-toggle="modal" data-target=".reject_modal"
                                    id="reject"
                                    data-id_reject="{{ $value->id_postingan }}"
                                    data-judul_reject="{{ $value->judul }}">
                                    <i class="fa fa-times"></i>                                       
                                </button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
      </div>
    </div>
</section>

<!-- Publish Modal -->
<div class="modal fade publish_modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title " id="exampleModalLabel">Publish Postingan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('postingan.publish')}}" method="post">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="id_publish" value="" id="id_publish" >   
                <p>Postingan : <b> <span id="judul_publish"></span> </b> akan di publish </p>     
                <input type="text" class="form-control" name="pesan" value="" id="pesan" placeholder="Silahkan masukkan pesan (optional)">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Publish Postingan</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Penutup Publish Modal -->

<!-- Reject Modal -->
<div class="modal fade reject_modal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" >
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title " id="exampleModalLabel">Reject Postingan</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <form action="{{route('postingan.reject')}}" method="post">
            @csrf
            <div class="modal-body">
                <input type="hidden" name="id_reject" value="" id="id_reject" >
                
                <p>Postingan : <b> <span id="judul_reject"></span> </b> akan di reject </p>     
                <input type="text" class="form-control" name="pesan" value="" id="pesan" placeholder="Silahkan masukkan pesan perbaikan ...">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-danger">Reject Postingan</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Penutup Reject Modal -->

<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script>
$(document).ready(function(){
    $(document).on('click','#publish', function(){
        var id_publish   = $(this).data('id_publish');   
        var judul_publish = $(this).data('judul_publish');   
        $('#id_publish').val(id_publish);
        $('#judul_publish').text(judul_publish);
    });  
    $(document).on('click','#reject', function(){
        var id_reject   = $(this).data('id_reject');   
        var judul_reject = $(this).data('judul_reject');   
        $('#id_reject').val(id_reject);
        $('#judul_reject').text(judul_reject);
    });     
});
</script>

@stop




