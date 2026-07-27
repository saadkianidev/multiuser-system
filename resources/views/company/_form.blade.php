<h5 class="mt-3">Company Info</h5>
<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $company->name ?? '') }}" required>
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $company->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<h5 class="mt-4">Profile</h5>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Address</label>
        <input type="text" name="address" class="form-control @error('address') is-invalid @enderror"
            value="{{ old('address', $company?->profile?->address ?? '') }}">
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">City</label>
        <input type="text" name="city" class="form-control @error('city') is-invalid @enderror"
            value="{{ old('city', $company?->profile?->city ?? '') }}">
        @error('city')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Country</label>
        <input type="text" name="country" class="form-control @error('country') is-invalid @enderror"
            value="{{ old('country', $company?->profile?->country ?? '') }}">
        @error('country')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
            value="{{ old('phone', $company?->profile?->phone ?? '') }}">
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label">Website</label>
        <input type="url" name="website" class="form-control @error('website') is-invalid @enderror"
            value="{{ old('website', $company?->profile?->website ?? '') }}">
        @error('website')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<h5 class="mt-4">Theme</h5>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Primary Color</label>
        <input type="color" name="primary_color" class="form-control form-control-color @error('primary_color') is-invalid @enderror"
            value="{{ old('primary_color', $company?->theme?->primary_color ?? '#0d6efd') }}">
        @error('primary_color')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Secondary Color</label>
        <input type="color" name="secondary_color" class="form-control form-control-color @error('secondary_color') is-invalid @enderror"
            value="{{ old('secondary_color', $company?->theme?->secondary_color ?? '#6c757d') }}">
        @error('secondary_color')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Font</label>
        <input type="text" name="font" class="form-control @error('font') is-invalid @enderror"
            value="{{ old('font', $company?->theme?->font ?? 'Inter') }}">
        @error('font')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>