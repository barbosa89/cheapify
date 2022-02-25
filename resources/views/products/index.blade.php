@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <product-index :products='@json($products->getCollection())'></product-index>
        </div>

        <div class="row">
            {{ $products->links() }}
        </div>
    </div>
@endsection
