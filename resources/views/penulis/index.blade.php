@extends('layouts.penulis.master')

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Dashboard Penulis</h1>
        <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="/home">Dashboard</a></div>
            <div class="breadcrumb-item">Penulis</div>
        </div>
    </div>

    <div class="section-body">

        <div class="row">
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card author-box card-primary">
                            <div class="card-body">
                                <div class="author-box-top text-center mb-3">
                                  @if ($user->penulis->image == null)
                                  <img alt="image" height="50px" src="../assets/img/avatar/avatar-1.png" class="rounded-circle author-box-picture">
                                  @else
                                  <img alt="image" width="full" src="../images/{{$user->penulis->image}}" class=" author-box-picture">
                                  @endif
                                </div>
                                <div class="author-box-bottom">
                                    <div class="author-box-name">
                                        <a href="#">{{$user->penulis->nama}}</a>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Aktivitas Terakhir</h4>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled list-unstyled-border list-unstyled-noborder">
                                @foreach($logs as $item)
                                <li class="media"> 
                                    <div class="media-body">
                                    <div class="media-right">
                                        @if($item->status == 'pending')
                                        <div class="text-warning">Pending</div>
                                        @elseif($item->status == 'rejected')
                                        <div class="text-danger">Rejected</div>
                                        @else
                                        <div class="text-success">Published</div>
                                        @endif
                                    </div>
                                    <div class="media-title mb-1">{{$item->judul}}</div>
                                    <div class="text-time">{{$item->updated_at}}</div>
                                    <div class="media-description text-muted">{{$item->pesan}}</div>
                                    <div class="media-links">
                                        <div class="bullet"></div>
                                        <a href="{{route('postingan.show', $item->postingan_id)}}" class="text-warning">Lihat Postingan</a>
                                    </div>
                                    </div>
                                </li>
                                @endforeach
                                </ul>
                            </div>
                            </div>
                    </div>
                </div>
                
            </div>

            <div class="col-md-6 container">
            <div class="row">
              @foreach($postingan as $item)
              <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                <article class="article article-style-b">
                  <div class="article-header">
                    <div class="article-image" data-background="../images/{{$item->gambar}}">
                    </div>
                  </div>
                  <div class="article-details">
                    <div class="article-title">
                      <h2><a href="#">{{$item->judul}}</a></h2>
                    </div>
                    <p>{!! Str::limit($item->isi, 50, ' ...') !!}</p>
                    <div class="article-cta">
                      <a href="#">Lihat selengkapnya<i class="fas fa-chevron-right"></i></a>
                    </div>
                  </div>
                </article>
              </div>
              @endforeach
            </div>
            </div>
        </div>
    
    </div>
</section>
@stop