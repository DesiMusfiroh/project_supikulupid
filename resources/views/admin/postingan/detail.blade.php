@extends('layouts.admin.master')

@section('content')

<section class="section">
    <div class="section-header">
        <h1>Detail Postingan Penulis</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
            <div class="breadcrumb-item active"><a href="/postingan_all">Postingan</a></div>
            <div class="breadcrumb-item">{{$postingan->judul}}</div>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>{{$postingan->judul}}</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="../images/{{$postingan->gambar}}" width="80%" alt="" class="" />
                        </div>
                        <p>{!!$postingan->isi!!}</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                    <div class="card-header"><h4>Penulis</h4></div>
                    <div class="card-body">
                                <div class="author-box-top text-center mb-3">
                                  @if ($user->penulis->image == null)
                                  <img alt="image" width="80%" src="../assets/img/avatar/avatar-1.png" class="rounded-circle author-box-picture">
                                  @else
                                  <img alt="image" width="80%" src="../images/{{$user->penulis->image}}" class=" author-box-picture">
                                  @endif
                                </div>
                                <div class="author-box-bottom">
                                    <div class="author-box-name">
                                        <h5>{{$user->penulis->nama}}</h5>
                                    </div>
                                    <div class="author-box-job">{{$user->email}}</div>
                                    <div class="author-box-description">
                                        <p>{!!$user->penulis->tentang!!}</p>
                                    </div>
                                </div>
                            </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
