@extends('layouts.main.main')

@section('container')
<?php use Illuminate\Support\Str; ?>
    <div class="container">
        <div class="row">
            <div class="col-xl-8 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    @foreach($postingan as $item)
                    <div class="row">
                      <div class="col-sm-4">
                        <div class="position-relative">
                          <div class="rotate-img">
                            <img
                              src="../images/{{$item->gambar}}"
                              alt="thumb"
                              class="img-fluid"
                            />
                          </div>
                          <div class="badge-positioned">
                            <span class="badge badge-warning font-weight-bold">{{$item->kategori->nama}}</span>
                          </div>
                        </div>
                      </div>
                      <div class="col-sm-8">
                        <h2 class="mb-2 font-weight-600"> {{$item->judul}} </h2>
                        <div class="fs-13 mb-2">
                          <span class="mr-2">{{$item->user->username}} </span> {{$item->published_at}}
                        </div>
                        <p class="mb-0"> {!! Str::limit($item->isi, 180, ' ...') !!} </p>
                      </div>
                    </div>
                    @endforeach
                   
                  </div>
                </div>
            </div>

            <div class="col-xl-4 stretch-card grid-margin">
                <div class="card ">
                  <div class="card-body">
                    <h2>Yang Lagi Rame</h2>

                    <div class="d-flex border-bottom-blue pt-3 pb-4 align-items-center justify-content-between">
                      <div class="pr-3">
                        <h5>Virus Kills Member Of Advising Iran’s Supreme</h5>
                        <div class="fs-12">
                          <span class="mr-2">Photo </span>10 Minutes ago
                        </div>
                      </div>
                      <div class="rotate-img">
                        <img
                          src="assets/images/dashboard/home_1.jpg"
                          alt="thumb"
                          class="img-fluid img-lg"
                        />
                      </div>
                    </div>

                    
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection