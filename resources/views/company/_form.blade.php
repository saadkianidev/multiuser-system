<h5 class="mt-3">Company Info</h5>
<div class="mb-3">
    <label class="form-label">Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $company->name ?? '') }}" required>
    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
</div>
<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ old('description', $company->description ?? '') }}</textarea>
</div>

<h5 class="mt-4">Profile</h5>
<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label">Address</label>
        <input type="text" name="address" class="form-control" value="{{ old('address', $company?->profile?->address ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">City</label>
        <input type="text" name="city" class="form-control" value="{{ old('city', $company->profile->city ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Country</label>
        <input type="text" name="country" class="form-control" value="{{ old('country', $company->profile->country ?? '') }}">
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone', $company->profile->phone ?? '') }}">
    </div>
    <div class="col-md-12 mb-3">
        <label class="form-label">Website</label>
        <input type="url" name="website" class="form-control" value="{{ old('website', $company->profile->website ?? '') }}">
    </div>
</div>

<h5 class="mt-4">Theme</h5>
<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label">Primary Color</label>
        <input type="color" name="primary_color" class="form-control form-control-color" value="{{ old('primary_color', $company->theme->primary_color ?? '#0d6efd') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Secondary Color</label>
        <input type="color" name="secondary_color" class="form-control form-control-color" value="{{ old('secondary_color', $company->theme->secondary_color ?? '#6c757d') }}">
    </div>
    <div class="col-md-4 mb-3">
        <label class="form-label">Font</label>
        <input type="text" name="font" class="form-control" value="{{ old('font', $company->theme->font ?? 'Inter') }}">
    </div>
</div>