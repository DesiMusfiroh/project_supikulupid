@extends('layouts.admin.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard Admin</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
            <div class="breadcrumb-item">Admin</div>
        </div>
    </div>

    <div class="section-body">
        <h2 class="section-title">Postingan Penulis</h2>
        <div class="row">
            @foreach($postingan as $item)
            <div class="col-12 col-md-4 col-lg-4">
                <article class="article article-style-c">
                <div class="article-header">
                    <div class="article-image" data-background="../images/{{$item->gambar}}">
                    </div>
                </div>
                <div class="article-details">
                    <div class="article-category"><a href="#">{{$item->kategori->nama}}</a> <div class="bullet"></div> <a href="#">{{$item->updated_at}}</a></div>
                    <div class="article-title">
                    <h2><a href="#">{{$item->judul}}</a></h2>
                    </div>
                    <p>{!! Str::limit($item->isi, 150, ' ...') !!}</p>
                    <div class="article-user">
                        @if ($item->user->penulis->image == null)
                        <img alt="image" src="../assets/img/avatar/avatar-1.png">
                        @else
                        <img alt="image" src="../images/{{$item->user->penulis->image}}">
                        @endif
                    <div class="article-user-details">
                        <div class="user-detail-name">
                        <a href="#">{{$item->user->email}}</a>
                        </div>
                        <div class="text-job">{{$item->user->username}}</div>
                    </div>
                    </div>
                </div>
                </article>
            </div>
            @endforeach
        </div>
    </div>
</section>
@stop