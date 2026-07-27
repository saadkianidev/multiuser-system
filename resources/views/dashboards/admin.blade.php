@extends('layouts.dashboard')
@section('title', 'Admin Dashboard')

@section('content')
    <h2>Admin Dashboard</h2>

    <div class="mb-3">
        <a href="{{ route('admin.companies.index') }}" class="btn btn-outline-primary btn-sm">Manage Companies</a>
        <a href="{{ route('admin.employees.index') }}" class="btn btn-outline-primary btn-sm">Manage Employees</a>
        {{-- <a href="{{ route('conversations.index') }}" class="btn btn-outline-success btn-sm">Conversations</a> --}}
    </div>

    {{-- Companies Section --}}
    <h4 class="mt-4">My Companies</h4>
    <table class="table table-striped table-bordered mb-4">
        <thead>
            <tr><th>Name</th><th>Description</th><th>Employees</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($companies as $company)
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ Str::limit($company->description, 50) }}</td>
                    <td>{{ $company->users->count() }}</td>
                    <td>
                        <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-sm btn-primary">Edit</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No companies found. 
                        <a href="{{ route('admin.companies.create') }}">Add one</a>.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Employees Section --}}
    <h4>Company Users</h4>
    <table class="table table-striped table-bordered">
        <thead>
            <tr><th>Name</th><th>Email</th><th>Company</th><th>Role</th></tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->company->name ?? '—' }}</td>
                    <td>{{ $user->getRoleNames()->first() ?? '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center text-muted">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection