<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="{{ route('student.dashboard') }}">
            <span class="align-middle sidebar-brand-text">
                {{ config('app.name') }}
            </span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">
                Main
            </li>

            <li class="sidebar-item {{ request()->routeIs('student.dashboard') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('student.dashboard') }}">
                    <i class="align-middle bi bi-house-door"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <li class="sidebar-header">
                Jobs
            </li>

            <li class="sidebar-item {{ request()->routeIs('student.jobs.*') ? 'active' : '' }}">
                <a data-bs-target="#jobs" data-bs-toggle="collapse" class="sidebar-link collapsed"
                   aria-expanded="{{ request()->routeIs('student.jobs.*') ? 'true' : 'false' }}">
                    <i class="align-middle bi bi-briefcase"></i>
                    <span class="align-middle">Jobs</span>
                </a>
                <ul id="jobs" class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('student.jobs.*') ? 'show' : '' }}" data-bs-parent="#sidebar">
                    <li class="sidebar-item {{ request()->routeIs('student.jobs.available') ? 'active' : '' }}">
                        <a class="sidebar-link" href="">Available Jobs</a>
                    </li>
                    <li class="sidebar-item {{ request()->routeIs('student.jobs.applied') ? 'active' : '' }}">
                        <a class="sidebar-link" href="">Applied Jobs</a>
                    </li>
                </ul>
            </li>

            <li class="sidebar-item {{ request()->routeIs('student.job-fairs.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="">
                    <i class="align-middle bi bi-calendar-event"></i>
                    <span class="align-middle">Job Fairs</span>
                </a>
            </li>

            <li class="sidebar-header">
                Settings
            </li>

            <li class="sidebar-item {{ request()->routeIs('student.profile') ? 'active' : '' }}">
                <a class="sidebar-link" href="">
                    <i class="align-middle bi bi-person"></i>
                    <span class="align-middle">Profile</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
