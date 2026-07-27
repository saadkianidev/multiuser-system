<section class="d-flex flex-column gap-4">
    <header>
        <h2 class="fs-5 fw-medium text-dark">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 small text-secondary">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <div>
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">
            {{ __('Delete Account') }}
        </button>
    </div>

    <div class="modal fade" id="confirm-user-deletion" tabindex="-1" aria-labelledby="confirm-user-deletion-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-body p-4">
                        <h2 class="fs-5 fw-medium text-dark" id="confirm-user-deletion-label">
                            {{ __('Are you sure you want to delete your account?') }}
                        </h2>

                        <p class="mt-1 small text-secondary">
                            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                        </p>

                        <div class="mt-4">
                            <label for="password" class="visually-hidden">{{ __('Password') }}</label>

                            <input id="password" name="password" type="password"
                                class="form-control w-75 @error('password', 'userDeletion') is-invalid @enderror"
                                placeholder="{{ __('Password') }}">

                            @error('password', 'userDeletion')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-4 d-flex justify-content-end gap-3">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                {{ __('Cancel') }}
                            </button>

                            <button type="submit" class="btn btn-danger">
                                {{ __('Delete Account') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @if ($errors->userDeletion->isNotEmpty())
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const modalEl = document.getElementById('confirm-user-deletion');
                if (modalEl) {
                    new bootstrap.Modal(modalEl).show();
                }
            });
        </script>
    @endif
</section>