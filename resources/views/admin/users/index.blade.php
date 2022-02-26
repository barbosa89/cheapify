@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="card table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Verification</th>
                            <th scope="col">Status</th>
                            <th scope="col">Options</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->email_verified_at->toDateString() }}</td>
                                <td>{{ $user->status }}</td>
                                <td>
                                    <a
                                        href="{{ route('admin.users.toggle', $user) }}"
                                        @class([
                                            "btn",
                                            "btn-danger" => $user->enabled,
                                            "btn-primary" => !$user->enabled,
                                        ])>
                                        {{ $user->enabled ? trans('common.actions.disable') : trans('common.actions.enable') }}
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="row mt-5">
            {{ $users->links() }}
        </div>
    </div>
@endsection
