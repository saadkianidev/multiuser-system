@extends('layouts.dashboard')
@section('title', 'My Companies')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h2>My Companies</h2>
        <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">Add Company</a>
    </div>

    @if(session('status'))
        <div class="alert alert-success mt-3">{{ session('status') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger mt-3">{{ session('error') }}</div>
    @endif

    <table class="table table-striped mt-3">
        <thead>
            <tr><th>Name</th><th>City</th><th>Website</th><th>Actions</th></tr>
        </thead>
        <tbody>
            @forelse($companies as $company)
                <tr>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->profile->city ?? '—' }}</td>
                    <td>{{ $company->profile->website ?? '—' }}</td>
                    <td>
                        <a href="{{ route('admin.companies.edit', $company) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                        <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this company?')">
                            @csrf @method('DELETE')
                            <button class="btn btn-sm btn-outline-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">You don't own any companies yet.</td></tr>
            @endforelse
        </tbody>
    </table>
@endsection