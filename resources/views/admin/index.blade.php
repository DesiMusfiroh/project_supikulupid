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


            <h2 class="section-title">Proses Postingan Terbaru</h2>
            <div class="row">
                @foreach($postingan_processed as $item)
                <div class="col-12 col-md-4 col-lg-4">
                    <article class="article article-style-c">
                    <div class="article-header">
                        <div class="article-image" data-background="../assets/img/news/img13.jpg">
                        </div>
                    </div>
                    <div class="article-details">
                        <div class="article-category"><a href="#">{{$item->kategori->nama}}</a> <div class="bullet"></div> <a href="#">{{$item->updated_at}}</a></div>
                        <div class="article-title">
                        <h2><a href="#">{{$item->judul}}</a></h2>
                        </div>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse
                        cillum dolore eu fugiat nulla pariatur. </p>
                        <div class="article-user">
                        <img alt="image" src="../assets/img/avatar/avatar-1.png">
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