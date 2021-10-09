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
      <div class="row">
        @foreach($postingan as $value) 
          
          <div class="col-12 col-sm-6 col-md-6 col-lg-3">
            <article class="article article-style-b">
              <div class="article-header">
                <div class="article-image" data-background="../images/{{$value->gambar}}">
                </div>
              </div>
              <div class="article-details">
                <div class="article-title">
                  <h2><a href="#">{{$value->judul}}</a></h2>
                </div>
                <p>{!!$value->ini!!}</p>
                <div class="article-cta">
                  <a href="#">Baca selengkapnya <i class="fas fa-chevron-right"></i></a>
                </div>
              </div>
            </article>
          </div>
          
        @endforeach
      </div>
    </div>
</section>

@stop




