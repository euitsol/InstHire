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

            <li class="sidebar-item {{ request()->routeIs('student.job.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('student.job.index') }}">
                    <i class="align-middle bi bi-briefcase"></i>
                    <span class="align-middle">My Jobs</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('student.job-fairs.*') ? 'active' : '' }}">
                <a class="sidebar-link" href="">
                    <i class="align-middle bi bi-calendar-event"></i>
                    <span class="align-middle">Job Fairs</span>
                </a>
            </li>

            <li class="sidebar-item {{ request()->routeIs('student.cv.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('student.cv.index') }}">
                    <i class="align-middle bi bi-file-earmark-text"></i>
                    <span class="align-middle">My CVs</span>
                </a>
            </li>

            <li class="sidebar-header">
                Settings
            </li>

            <li class="sidebar-item {{ request()->routeIs('student.profile.index') ? 'active' : '' }}">
                <a class="sidebar-link" href="{{ route('student.profile.index') }}">
                    <i class="align-middle bi bi-person"></i>
                    <span class="align-middle">Profile</span>
                </a>
            </li>
        </ul>
    </div>
</nav>
