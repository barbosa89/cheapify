<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product list</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body>
    <div class="container">
        @foreach ($products->chunk(4) as $chunk)
            <div class="row my-4">
                @foreach ($chunk as $product)
                    <div class="col-3">
                        <div class="card">
                            <img src="{{ $product->image->content }}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{ $product->title }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">$ {{ $product->price }}</h6>
                                <p class="card-text">Facturas: {{ $product->invoices_count  }}.</p>
                                <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
