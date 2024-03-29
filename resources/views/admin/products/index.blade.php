@extends('layouts.app')

@section('content')
    <div class="container">
        <admin-product-index :products='@json($products->getCollection())'></admin-product-index>

        <div class="row">
            {{ $products->links() }}
        </div>
    </div>
@endsection
