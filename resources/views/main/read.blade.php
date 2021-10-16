@extends('layouts.main.main')

@section('container')

<?php use Illuminate\Support\Str; ?>
    <div class="container">
        <div class="row">
            <div class="col-xl-12 stretch-card grid-margin">
                <div class="card" >
                  <div class="card-body">
                    <div class="aboutus-wrapper">
                        <h1 class="mt-3">{{$postingan->judul}}</h1>
                        <div class="text-center">
                            <img src="../images/{{$postingan->gambar}}" alt="" class="img-fluid mt-3 mb-3 " />
                        </div>
                        <p class="font-weight-600 fs-15 text-center"> {!!$postingan->isi!!} </p>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection