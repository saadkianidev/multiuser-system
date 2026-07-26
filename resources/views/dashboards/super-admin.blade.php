@extends('layouts.dashboard')
@section('title', 'Super Admin Dashboard')

@section('content')
    <h2>Super Admin Dashboard</h2>
    <p>All users across all companies:</p>
    <table class="table table-striped">
        <thead>
            <tr><th>Name</th><th>Email</th><th>Company ID</th><th>Role</th></tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->company_id ?? '—' }}</td>
                    <td>{{ $user->getRoleNames()->first() ?? '—' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection