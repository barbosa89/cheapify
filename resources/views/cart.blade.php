@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row my-4">
            <div class="col">
                <p><small><a href="{{ url('/') }}">Volver</a></small></p>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Carrito de compras
                    </div>
                    <div class="row g-0">
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Información de pago</h5>
                                <form id="buy" action="{{ route('payments.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="name">Nombre</label>
                                        <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="document">Número de documento</label>
                                        <input type="text" name="document" id="document" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Correo</label>
                                        <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Dirección</label>
                                        <input type="text" name="address" id="address" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="gateway">Pasarela de pago</label>
                                        <select name="gateway" id="gateway" class="form-control" required>
                                            @foreach ($gateways as $gateway)
                                                <option value="{{ $gateway }}">{{ ucfirst($gateway) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body">
                                <h5 class="card-title">Productos</h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Producto</th>
                                            <th scope="col">Cantidad</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (Cart::content() as $item)
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->qty }}</td>
                                                <td>{{ $item->price }}</td>
                                                <td>{{ $item->qty * $item->price }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th scope="row">Total</th>
                                            <td colspan="4">{{ Cart::subtotal() }}</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="btn-group">
                            <button type="submit" form="buy" class="btn btn-default">
                                <em class="fas fa-money-bill"></em> Comprar
                            </button>
                            <form id="empty-cart" action="{{ route('cart.destroy') }}" method="POST">
                                @csrf
                                @method('DELETE')
                            </form>
                            <button type="submit" form="empty-cart" class="btn btn-default">
                                <em class="fas fa-trash"></em> Vaciar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
