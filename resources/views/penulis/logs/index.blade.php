@extends('layouts.penulis')

@section('breadcrumb')
    <h3 class="text-themecolor">Riwayat Aktivitas</h3>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
        <li class="breadcrumb-item active">Aktivitas</li>
    </ol>
@endsection

@section('content')
<div class="card p-4">

    <div class="card-header">
        <h4>Riwayat Aktivitas</h4>
    </div>
    <div class="bady-body">
        <table class="table table-striped table-bordered" width="100%" cellspacing="0">
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

@stop
