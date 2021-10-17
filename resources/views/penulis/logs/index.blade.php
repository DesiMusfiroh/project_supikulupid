@extends('layouts.penulis.master')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Aktivitas Saya</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
            <div class="breadcrumb-item">Aktivitas</div>
        </div>
    </div>

    <div class="section-body">
        <div class="card table-inside">
            <table class="table table-striped" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Judul</th>
                        <th class="text-center">Pesan</th>
                        <th class="text-center">Tanggal Kirim</th>
                        <th class="text-center">Tanggal Aksi</th>
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
                        </tr>
                @endforeach
                </tbody>
            </table>  
        </div>
    </div>
</section>

@stop
