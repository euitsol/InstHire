<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <!-- Logo -->
    <div class="p-3 d-flex align-items-center justify-content-between border-bottom">
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
        <div class="gap-2 d-flex flex-column">
            <a href="{{ route('institute.dashboard') }}"
                class="nav-link {{ request()->routeIs('institute.dashboard') ? 'active' : '' }}">
                <i class="bi bi-house"></i>
                Dashboard
            </a>

            <a href="{{ route('institute.profile') }}"
                class="nav-link {{ request()->routeIs('institute.profile') ? 'active' : '' }}">
                <i class="bi bi-person"></i>
                Profile
            </a>

            <a href="{{ route('institute.employee.index') }}"
                class="nav-link {{ request()->routeIs('institute.employee.*') ? 'active' : '' }}">
                <i class="bi bi-people"></i>
                Employees
            </a>

            <a class="nav-link {{ request()->routeIs('institute.job-post.*') ? 'active' : '' }}"
                data-bs-toggle="collapse" href="#job-nav" role="button"
                aria-expanded="{{ request()->routeIs('institute.job-post.*') ? 'true' : 'false' }}"
                aria-controls="job-nav">
                <i class="bi bi-briefcase"></i>
                Job Management

            </a>
            <ul id="job-nav"
                class="nav-content collapse {{ request()->routeIs('institute.job-post.*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('institute.job-post.index') }}"
                        class="nav-link {{ request()->routeIs('institute.job-post.*') ? 'active' : '' }}">
                        <span>Job Posts</span>
                    </a>
                </li>
            </ul>

            <ul class="nav nav-pills flex-column">
                <li class="nav-item">
                    <a href="{{ route('institute.jf.index') }}" class="nav-link {{ request()->routeIs('institute.jf.*') ? 'active' : '' }}">
                        <i class="bi bi-calendar2-event me-2"></i>
                        <span>{{ __('Job Fair') }}</span>
                    </a>
                </li>
            </ul>

            <a class="nav-link {{ request()->routeIs('institute.setup.*') ? 'active' : '' }}" data-bs-toggle="collapse"
                href="#setup-nav" role="button"
                aria-expanded="{{ request()->routeIs('institute.setup.*') ? 'true' : 'false' }}"
                aria-controls="setup-nav">
                <i class="bi bi-gear"></i>
                Setup

            </a>
            <ul id="setup-nav" class="nav-content collapse {{ request()->routeIs('institute.setup.*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('institute.setup.department.index') }}"
                        class="nav-link {{ request()->routeIs('institute.setup.department.*') ? 'active' : '' }}">
                        <span>Departments</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('institute.setup.session.index') }}"
                        class="nav-link {{ request()->routeIs('institute.setup.session.*') ? 'active' : '' }}">
                        <span>Sessions</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('institute.setup.jfs.list') }}"
                        class="nav-link {{ request()->routeIs('institute.setup.jfs.*') ? 'active' : '' }}">
                        <span>Job Fair Stall Options</span>
                    </a>
                </li>
            </ul>

            <a class="nav-link {{ request()->routeIs('institute.student.*') ? 'active' : '' }}"
                data-bs-toggle="collapse" href="#student-nav" role="button"
                aria-expanded="{{ request()->routeIs('institute.student.*') ? 'true' : 'false' }}"
                aria-controls="setup-nav">
                <i class="bi bi-people"></i>
                Student Management

            </a>
            <ul id="student-nav"
                class="nav-content collapse {{ request()->routeIs('institute.student.*') ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('institute.student.index') }}"
                        class="nav-link {{ request()->routeIs('institute.student.*') ? 'active' : '' }}">
                        <span>Students</span>
                    </a>
                </li>
            </ul>




        </div>
    </nav>

</div>

<!-- Mobile Sidebar Backdrop -->
<div class="sidebar-backdrop d-none" id="sidebarBackdrop"></div>
