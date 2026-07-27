<section>
    <header>
        <h2 class="fs-5 fw-medium text-dark">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 small text-secondary">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-4 d-flex flex-column gap-4">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="form-label">{{ __('Name') }}</label>
            <input id="name" name="name" type="text"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div>
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="small mt-2 text-dark">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" type="submit"
                            class="btn btn-link btn-sm text-secondary p-0 align-baseline text-decoration-underline">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 fw-medium small text-success">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>

            @if (session('status') === 'profile-updated')
                <p id="profile-saved-message" class="small text-secondary mb-0 fade show">
                    {{ __('Saved.') }}
                </p>

                <script>
                    setTimeout(() => {
                        const msg = document.getElementById('profile-saved-message');
                        if (msg) {
                            msg.classList.remove('show');
                            setTimeout(() => msg.remove(), 150);
                        }
                    }, 2000);
                </script>
            @endif
        </div>
    </form>
</section>