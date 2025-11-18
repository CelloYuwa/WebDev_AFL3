@extends('layout.mainlayout')

@section('title','Manage Users')
@section('subtitle','Admin panel for user management')

@section('content')
<div class="card shadow">
    <div class="card-body">
        <h4>Users</h4>
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ucfirst($user->role) }}</td>
                        <td>
                            <form method="POST" action="{{ route('users.toggleRole',$user->id) }}">
                                @csrf
                                <button type="submit" class="btn btn-sm btn-primary">
                                    Make {{ $user->role === 'admin' ? 'User' : 'Admin' }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
