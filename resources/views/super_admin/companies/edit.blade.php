<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark">{{ __('Edit Company') }}</h2>
    </x-slot>

    <div class="py-5">
        <div class="container" style="max-width: 48rem;">

            <button onclick="window.history.back()" class="btn btn-link btn-sm text-secondary text-decoration-none ps-0 mb-3">
                &larr; {{ __('Back') }}
            </button>

            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <form method="POST" action="{{ route('super_admin.companies.update', $company) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="owner_id" class="form-label">{{ __('Admin (Owner)') }}</label>
                            <select id="owner_id" name="owner_id"
                                class="form-select @error('owner_id') is-invalid @enderror" required>
                                @foreach ($admins as $admin)
                                    <option value="{{ $admin->id }}" {{ old('owner_id', $company->owner_id) == $admin->id ? 'selected' : '' }}>
                                        {{ $admin->name }} ({{ $admin->email }})
                                    </option>
                                @endforeach
                            </select>
                            @error('owner_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">{{ __('Company Name') }}</label>
                            <input id="name" name="name" type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $company->name) }}" required autofocus>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">{{ __('Description') }}</label>
                            <textarea id="description" name="description" rows="3"
                                class="form-control @error('description') is-invalid @enderror">{{ old('description', $company->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label for="address" class="form-label">{{ __('Address') }}</label>
                                <input id="address" name="address" type="text"
                                    class="form-control @error('address') is-invalid @enderror"
                                    value="{{ old('address', $company->profile?->address) }}">
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="city" class="form-label">{{ __('City') }}</label>
                                <input id="city" name="city" type="text"
                                    class="form-control @error('city') is-invalid @enderror"
                                    value="{{ old('city', $company->profile?->city) }}">
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="country" class="form-label">{{ __('Country') }}</label>
                                <input id="country" name="country" type="text"
                                    class="form-control @error('country') is-invalid @enderror"
                                    value="{{ old('country', $company->profile?->country) }}">
                                @error('country')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-6">
                                <label for="phone" class="form-label">{{ __('Phone') }}</label>
                                <input id="phone" name="phone" type="text"
                                    class="form-control @error('phone') is-invalid @enderror"
                                    value="{{ old('phone', $company->profile?->phone) }}">
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-12">
                                <label for="website" class="form-label">{{ __('Website') }}</label>
                                <input id="website" name="website" type="text"
                                    class="form-control @error('website') is-invalid @enderror"
                                    value="{{ old('website', $company->profile?->website) }}">
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
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