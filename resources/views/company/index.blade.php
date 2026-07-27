@extends('layouts.dashboard')
@section('title', 'My Companies')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fs-4 fw-semibold mb-0">My Companies</h2>
        <a href="{{ route('admin.companies.create') }}" class="btn btn-primary">Add Company</a>
    </div>

    {{-- <button onclick="window.history.back()" class="btn btn-link btn-sm text-secondary text-decoration-none ps-0 mb-3">
        &larr; {{ __('Back') }}
    </button> --}}

    @if (session('status'))
        <div class="alert alert-success" role="alert">{{ session('status') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped align-middle mb-0">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>City</th>
                    <th>Website</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($companies as $company)
                    <tr>
                        <td>{{ $company->name }}</td>
                        <td>{{ $company->profile->city ?? '—' }}</td>
                        <td>{{ $company->profile->website ?? '—' }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.companies.edit', $company) }}"
                                class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form action="{{ route('admin.companies.destroy', $company) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Delete this company?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-muted text-center py-3">
                            You don't own any companies yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
