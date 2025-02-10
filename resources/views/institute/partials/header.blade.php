<header class="header">
    <div class="container-fluid">
        <div class="d-flex align-items-center justify-content-between">
            <!-- Mobile menu button -->
            <button class="btn icon-button d-lg-none" id="toggleSidebar">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                </svg>
            </button>

            <!-- Right section -->
            <div class="d-flex align-items-center gap-3 ms-auto">
                <!-- Dark mode toggle -->
                <button class="btn icon-button" id="darkModeToggle">
                    <svg class="d-block dark-mode-hide" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                    </svg>
                    <svg class="d-none dark-mode-show" xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                    </svg>
                </button>

                <!-- Notifications -->
                <div class="dropdown">
                    <button class="btn icon-button" data-bs-toggle="dropdown">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
                        </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <div class="p-3 text-center text-muted">
                            No new notifications
                        </div>
                    </div>
                </div>

                <!-- Profile dropdown -->
                <div class="dropdown profile-dropdown">
                    <button class="btn d-flex align-items-center gap-2" data-bs-toggle="dropdown">
                        <img class="rounded-circle" width="32" height="32"
                             src="https://ui-avatars.com/api/?name={{ urlencode(auth()->guard('institute')->user()->name) }}&background=0D8ABC&color=fff" 
                             alt="{{ auth()->guard('institute')->user()->name }}">
                        <span class="d-none d-md-block">{{ auth()->guard('institute')->user()->name }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                        </svg>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <div class="dropdown-header">
                            <div class="fw-medium">{{ auth()->guard('institute')->user()->name }}</div>
                            <div class="text-muted">{{ auth()->guard('institute')->user()->email }}</div>
                        </div>
                        <a href="{{ route('institute.profile') }}" class="dropdown-item">Profile</a>
                        <a href="#" class="dropdown-item">Settings</a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('institute.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">Sign out</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
