@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card p-0 table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Content</th>
                            <th scope="col">Options</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $notification)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>
                                    <a href="{{ $notification->data['route'] }}">
                                        @lang('notifications.invoice', ['reference' => $notification->data['reference']])
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('notifications.mark', ['notification' => $notification->id]) }}" class="btn btn-default">
                                        Mark as read
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer">
                    <a href="{{ route('notifications.all') }}" class="btn btn-default">
                        Mark all as read
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
