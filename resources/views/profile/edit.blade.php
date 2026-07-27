<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 text-dark">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="container d-flex flex-column gap-4" style="max-width: 60rem;">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div style="max-width: 36rem;">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div style="max-width: 36rem;">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div style="max-width: 36rem;">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>