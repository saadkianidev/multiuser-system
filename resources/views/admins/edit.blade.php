<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark">
            {{ __('Edit Admin') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container" style="max-width: 48rem;">

            <button onclick="window.history.back()" class="btn btn-link btn-sm text-secondary text-decoration-none ps-0 mb-3">
                &larr; {{ __('Back') }}
            </button>

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <form method="POST" action="{{ route('super_admin.admins.update', $admin) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Name') }}</label>
                            <input id="name" name="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $admin->name) }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" name="email" type="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email', $admin->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('New Password (optional)') }}</label>
                            <input id="password" name="password" type="password"
                                class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>