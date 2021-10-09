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
            <div class="card author-box card-primary">
                  <div class="card-body">
                    <div class="author-box-left">
                      <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle author-box-picture">
                      <div class="clearfix"></div>
                    </div>
                    <div class="author-box-details">
                      <div class="author-box-name">
                        <a href="#">{{$user->penulis->nama}}</a>
                      </div>
                      <div class="author-box-job">{{$user->email}}</div>
                      <div class="author-box-description">
                        <p>{{$user->penulis->tentang}}</p>
                      </div>
                     
                    </div>
                  </div>
                </div>
            </div>
        </div>
    
    </div>
</section>
@stop