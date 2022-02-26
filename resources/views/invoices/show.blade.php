@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col mb-4">
                <h1>Reference {{ $invoice->reference }}</h1>
            </div>
        </div>
        <div class="row">
            <div class="card p-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <p><strong>Total</strong>: {{ $invoice->total }}</p>
                        </div>
                        <div class="col">
                            <p><strong>Payment Status</strong>: {{ $invoice->payment_status }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <p><strong>Currency</strong>: {{ $invoice->currency->code }}</p>
                        </div>
                        <div class="col">
                            <p><strong>Created at</strong>: {{ $invoice->created_at->toDateString() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5">
            <div class="card table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Price</th>
                            <th scope="col">Maker</th>
                            <th scope="col">Options</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoice->products as $product)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->make }}</td>
                                <td>
                                    <a href="{{ route('products.show', ['slug' => $product->slug]) }}" class="btn btn-default">
                                        <em class="fas fa-eye"></em>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
