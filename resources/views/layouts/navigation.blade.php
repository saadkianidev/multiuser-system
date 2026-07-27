<nav class="navbar navbar-expand-sm navbar-light bg-white border-bottom">
    <div class="container-fluid px-4 px-sm-5">

        <!-- Logo (kept commented, matching original) -->
        {{-- <a class="navbar-brand" href="{{ route('dashboard') }}">
            <x-application-logo class="d-block" style="height: 2.25rem;" />
        </a> --}}

        <!-- Hamburger -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar"
            aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <!-- Navigation Links -->
            <ul class="navbar-nav ms-sm-4 me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-semibold' : '' }}"
                        href="{{ route('dashboard') }}">
                        {{ __('Dashboard') }}
                    </a>
                </li>
            </ul>

            <!-- Settings Dropdown -->
            <ul class="navbar-nav ms-auto d-none d-sm-flex">
                <li class="nav-item dropdown">
                    <button class="btn btn-light btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                {{ __('Profile') }}
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- Responsive Settings Options (shown only when collapsed/mobile) -->
            <div class="d-sm-none pt-3 pb-1 border-top mt-3">
                <div class="px-2">
                    <div class="fw-medium">{{ Auth::user()->name }}</div>
                    <div class="fw-medium small text-secondary">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3">
                    <a class="d-block px-2 py-1 text-decoration-none" href="{{ route('profile.edit') }}">
                        {{ __('Profile') }}
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="d-block w-100 text-start px-2 py-1 border-0 bg-transparent text-decoration-none">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>