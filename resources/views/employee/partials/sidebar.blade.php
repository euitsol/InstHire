<!-- Sidebar -->
<aside class="sidebar">
    <!-- Close Button (Mobile) -->
    <button type="button" class="btn btn-link text-body p-0 sidebar-close" id="sidebarClose">
        <i class="bi bi-x-lg fs-4"></i>
    </button>

    <!-- Logo -->
    <div class="p-3">
        <a href="{{ route('employee.dashboard') }}" class="d-block">
            <h3 class="h4 ps-2 m-0 fw-semibold">{{ config('app.name') }}</h3>
        </a>
    </div>

    <!-- Navigation -->
    <div class="flex-grow-1 px-3 py-2">
        <ul class="nav flex-column gap-1">
            <!-- Dashboard -->
            <li class="nav-item">
                <a href="{{ route('employee.dashboard') }}" class="nav-link {{ request()->routeIs('employee.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Job Management -->
            <li class="nav-item">
                <a href="#jobMenu" class="nav-link submenu-toggle collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="jobMenu">
                    <div class="menu_text">
                        <i class="bi bi-briefcase"></i>
                        <span>Job Management</span>
                    </div>
                    <i class="bi bi-chevron-down ms-auto submenu-arrow"></i>
                </a>
                <div class="collapse submenu" id="jobMenu">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="{{ route('employee.job-posts.create') }}" class="nav-link {{ request()->routeIs('employee.job-posts.create') ? 'active' : '' }}">
                                <i class="bi bi-plus-circle"></i>
                                <span>Post New Job</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employee.job-posts.index') }}" class="nav-link {{ request()->routeIs('employee.job-posts.index') ? 'active' : '' }}">
                                <i class="bi bi-list-ul"></i>
                                <span>Active Jobs</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employee.job-posts.archive') }}" class="nav-link {{ request()->routeIs('employee.job-posts.archive') ? 'active' : '' }}">
                                <i class="bi bi-archive"></i>
                                <span>Archived Jobs</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Applications -->
            <li class="nav-item">
                <a href="#applicationMenu" class="nav-link submenu-toggle collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="applicationMenu">
                    <div class="menu_text">
                        <i class="bi bi-file-earmark-text"></i>
                        <span>Applications</span>
                    </div>
                    <i class="bi bi-chevron-down ms-auto submenu-arrow"></i>
                </a>
                <div class="collapse submenu" id="applicationMenu">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-inbox"></i>
                                <span>New Applications</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-clock-history"></i>
                                <span>In Progress</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-check-circle"></i>
                                <span>Accepted</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-x-circle"></i>
                                <span>Rejected</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>

            <!-- Settings -->
            <li class="nav-item">
                <a href="#settingsMenu" class="nav-link submenu-toggle collapsed" data-bs-toggle="collapse" role="button" aria-expanded="false" aria-controls="settingsMenu">
                    <div class="menu_text">
                        <i class="bi bi-gear"></i>
                    <span>Settings</span>
                    </div>
                    <i class="bi bi-chevron-down ms-auto submenu-arrow"></i>
                </a>
                <div class="collapse submenu" id="settingsMenu">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a href="{{ route('employee.profile') }}" class="nav-link {{ request()->routeIs('employee.profile') ? 'active' : '' }}">
                                <i class="bi bi-person"></i>
                                <span>Profile</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('employee.profile.security') }}" class="nav-link {{ request()->routeIs('employee.profile.security') ? 'active' : '' }}">
                                <i class="bi bi-shield-lock"></i>
                                <span>Security</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="bi bi-bell"></i>
                                <span>Notifications</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>

    <!-- Footer -->
    <div class="p-3 border-top">
        <form action="{{ route('employee.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link text-body w-100 text-start p-2 rounded-2">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
            </button>
        </form>
    </div>
</aside>

<!-- Sidebar Backdrop -->
<div class="sidebar-backdrop d-none" id="sidebarBackdrop"></div>
