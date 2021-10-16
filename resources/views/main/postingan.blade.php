@extends('layouts.main.main')
@section('container')
    <div class="container">
        <div class="text-center mb-4">
            <h2>{{$title}}</h2>
        </div>
        <div class="row">
            @foreach($postingan as $item)
            <div class="col-sm-12 col-md-4 col-lg-4">
                <div class="card mb-3">
                    <img src="../images/{{$item->gambar}}" class="card-img-top" alt="..." height="200px" >
                    <div class="card-body">
                        <h5 class="card-title">{{$item->judul}}</h5>
                        <p>
                            <small class="text-muted">
                                Published at : {{$item->published_at}} |
                                By. <a href="" class="text-decoration-none">{{$item->user->username}}</a>
                            </small>
                        </p>
                        <p class="card-text">{!! Str::limit($item->isi, 70, ' ...') !!}</p>
                        <a href="{{route('read', $item->id_postingan)}}" class="btn btn-primary mt-1">Read More..</a>
                       
                    </div>
                </div>
            </div>
            @endforeach 
        </div>
    </div>
@endsection