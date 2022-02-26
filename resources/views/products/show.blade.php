@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="col">
                <p><small><a href="{{ url()->previous() }}">Back</a></small></p>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col">
                <h1>{{ $product->name }}</h1>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                                <div class="carousel-inner main-carousel">
                                    @foreach ($product->images as $image)
                                        <div @class(['carousel-item', 'h-100', 'active' => $loop->first])>
                                            <img src="{{ $image->content }}" class="d-block w-100 h-100" alt="{{ $product->name }}">
                                        </div>
                                    @endforeach
                                </div>
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Previous</span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="visually-hidden">Next</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">$ {{ $product->price }}</h5>
                                <p class="card-text">{{ $product->description }}</p>
                                <p class="card-text"><small class="text-muted">Available stock: {{ $product->stock }}</small></p>
                                <div class="card-text mb-2">
                                    <strong>Maker</strong>
                                </div>
                                <ul class="list-group">
                                    @foreach ($product->maker as $key => $value)
                                        <li class="list-group-item">
                                            <strong>{{ $key }}</strong>: {{ $value }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
