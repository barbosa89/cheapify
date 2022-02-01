@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
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
        </div>

        <div class="row">
            <div class="col mt-2">
                <h1>{{ $product->name }}</h1>
                <h2><small>$ {{ $product->price }}</small></h2>
                <p>{{ $product->description }}</p>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <div class="btn-group btn-block w-100" role="group" aria-label="Basic example">
                    <a href="{{ route('products.show', ['slug' => $product->slug]) }}" class="btn btn-light">
                        <em class="fas fa-eye"></em> Ver
                    </a>
                    <form id="add-cart-{{ $product->id }}" action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="slug" value="{{ $product->slug }}">
                    </form>
                    <button type="submit" class="btn btn-light" form="add-cart-{{ $product->id }}">
                        <em class="fas fa-cart-plus"></em> Comprar
                    </button>
                </div>
            </div>
        </div>

        <hr>

        @foreach ($products->chunk(4) as $chunk)
            <div class="row my-4">
                @foreach ($chunk as $product)
                    <div class="col-3">
                        <div class="card">
                            <img src="{{ $product->image->content }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">$ {{ $product->price }}</h6>
                                <p class="card-text">{{ Str::limit($product->description, 60) }}.</p>
                                <div class="btn-group btn-block w-100" role="group" aria-label="Basic example">
                                    <a href="{{ route('products.show', ['slug' => $product->slug]) }}" class="btn btn-default">
                                        <em class="fas fa-eye"></em> Ver
                                    </a>
                                    <form id="add-cart-{{ $product->id }}" action="{{ route('cart.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="slug" value="{{ $product->slug }}">
                                    </form>
                                    <button type="submit" class="btn btn-default" form="add-cart-{{ $product->id }}">
                                        <em class="fas fa-cart-plus"></em> Comprar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
