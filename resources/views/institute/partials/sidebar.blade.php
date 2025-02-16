<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="d-flex align-items-center justify-content-between p-3 border-bottom">
        <a href="{{ route('institute.dashboard') }}" class="d-flex align-items-center text-decoration-none">
            {{-- <img src="{{ asset('images/logo.png') }}" alt="Logo" class="me-2" width="32" height="32"> --}}
            <span class="fs-4 fw-semibold text-dark">{{ config('app.name') }}</span>
        </a>
        <button class="btn icon-button d-lg-none" id="closeSidebar">
            <svg width="24" height="24" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="p-3">
        <div class="d-flex flex-column gap-2">
            <a href="{{ route('institute.dashboard') }}"
               class="nav-link {{ request()->routeIs('institute.dashboard') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                </svg>
                Dashboard
            </a>

            <a href="{{ route('institute.profile') }}"
               class="nav-link {{ request()->routeIs('institute.profile') ? 'active' : '' }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
                Profile
            </a>
        </div>
    </nav>
</div>

<!-- Mobile Sidebar Backdrop -->
<div class="sidebar-backdrop d-none" id="sidebarBackdrop"></div>
