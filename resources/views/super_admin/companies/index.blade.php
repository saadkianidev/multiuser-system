<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark">
            {{ __('Manage Companies') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container">

            <button onclick="window.history.back()" class="btn btn-link btn-sm text-secondary text-decoration-none ps-0 mb-3">
                &larr; {{ __('Back') }}
            </button>

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="fs-5 fw-semibold mb-0">Companies</h3>
                        <a href="{{ route('super_admin.companies.create') }}" class="btn btn-primary btn-sm">
                            + Add Company
                        </a>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success py-2 small mb-3" role="alert">{{ session('status') }}</div>
                    @endif
                    @if (session('error'))
                        <div class="alert alert-danger py-2 small mb-3" role="alert">{{ session('error') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Owner (Admin)</th>
                                    <th>City</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($companies as $company)
                                    <tr>
                                        <td>{{ $company->name }}</td>
                                        <td>{{ $company->owner?->name ?? '—' }}</td>
                                        <td>{{ $company->profile?->city ?? '—' }}</td>
                                        <td class="text-end">
                                            <a href="{{ route('super_admin.companies.edit', $company) }}"
                                                class="text-primary small me-3 text-decoration-none">Edit</a>

                                            <form action="{{ route('super_admin.companies.destroy', $company) }}"
                                                method="POST" class="d-inline"
                                                onsubmit="return confirm('Delete this company?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="btn btn-link text-danger small p-0 text-decoration-none">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-muted text-center py-3">
                                            No companies found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>