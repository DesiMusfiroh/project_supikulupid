@extends('layouts.main.main')
@section('container')
    <div class="container">
        <div class="row row-cols-4">
            @foreach($berita as $item)
            <div class="col">
                <div class="card" style="width: 18rem;">
                    <img src="../images/{{$item->gambar}}" class="card-img-top" alt="...">
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
            </div>
            @endforeach
        </div>
    </div>

@endsection