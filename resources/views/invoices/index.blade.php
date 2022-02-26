@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Reference</th>
                            <th scope="col">Total</th>
                            <th scope="col">Payment status</th>
                            <th scope="col">Currency</th>
                            <th scope="col">Created at</th>
                            <th scope="col">Options</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($invoices as $invoice)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $invoice->reference }}</td>
                                <td>{{ number_format($invoice->total, 2, ',', '.') }}</td>
                                <td>{{ $invoice->payment_status }}</td>
                                <td>{{ $invoice->currency->code }}</td>
                                <td>{{ $invoice->created_at->toDateString() }}</td>
                                <td>
                                    <a href="{{ route('invoices.show', $invoice) }}" class="btn btn-default">
                                        <em class="fas fa-eye"></em>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-5">
            {{ $invoices->links() }}
        </div>
    </div>
@endsection
