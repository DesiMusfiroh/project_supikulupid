@extends('layouts.main.main')


@section('container')
    <div class="container">
        <div class="row">
            <div class="card col-md-8">
                <div class="row g-0">
                    <div class="col-md-4">
                        <img src="/assets/img/unsplash/andre-benz-1214056-unsplash.jpg" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                        <h5 class="card-title">Card title</h5>
                        <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-1"></div> --}}
            <div class="card col-md-3 px-0" style="margin-left: 10px;">
                <h2 class="text-center">Yang Lagi Rame</h2>
                {{-- <div class="card-header">
                Featured
                </div> --}}
                <ul class="list-group list-group-flush">
                <li class="list-group-item">An item</li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
                <li class="list-group-item">A fourth item</li>
                </ul>
            </div>
        </div>
    </div>
@endsection