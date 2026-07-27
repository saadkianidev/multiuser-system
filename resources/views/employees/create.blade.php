<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark">
            {{ __('Add Employee') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container" style="max-width: 48rem;">

            <button onclick="window.history.back()" class="btn btn-link btn-sm text-secondary text-decoration-none ps-0 mb-3">
                &larr; {{ __('Back') }}
            </button>

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <form method="POST" action="{{ route('admin.employees.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" name="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" name="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input id="password" name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="company_id" class="form-label">{{ __('Company') }}</label>
                            <select id="company_id" name="company_id"
                                class="form-select @error('company_id') is-invalid @enderror" required>
                                <option value="">-- {{ __('Select Company') }} --</option>
                                @foreach ($companies as $company)
                                    <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                                        {{ $company->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('company_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="role" class="form-label">{{ __('Role') }}</label>
                            <select id="role" name="role"
                                class="form-select @error('role') is-invalid @enderror" required>
                                <option value="employee" {{ old('role') == 'employee' ? 'selected' : '' }}>Employee</option>
                                <option value="guest" {{ old('role') == 'guest' ? 'selected' : '' }}>Guest</option>
                            </select>
                            @error('role')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>