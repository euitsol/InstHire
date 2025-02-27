<nav class="navbar navbar-expand navbar-light navbar-bg">
    <a class="sidebar-toggle js-sidebar-toggle">
        <i class="hamburger align-self-center"></i>
    </a>

    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle" href="#" id="alertsDropdown" data-bs-toggle="dropdown">
                    <div class="position-relative">
                        <i class="align-middle bi bi-bell"></i>
                        <span class="indicator">4</span>
                    </div>
                </a>
                <div class="py-0 dropdown-menu dropdown-menu-lg dropdown-menu-end" aria-labelledby="alertsDropdown">
                    <div class="dropdown-menu-header">
                        4 New Notifications
                    </div>
                    <div class="list-group">
                        <!-- Add notifications here -->
                    </div>
                    <div class="dropdown-menu-footer">
                        <a href="#" class="text-muted">Show all notifications</a>
                    </div>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle bi bi-three-dots"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    @if(student()->image)
                        <img src="{{ asset('storage/' . student()->image) }}" class="rounded avatar img-fluid me-1" alt="{{ student()->name }}" />
                    @else
                        <img src="{{ asset('student/img/avatars/default.jpg') }}" class="rounded avatar img-fluid me-1" alt="{{ student()->name }}" />
                    @endif
                    <span class="text-dark">{{ student()->name }}</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="">
                        <i class="align-middle bi bi-person me-1"></i> Profile
                    </a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="align-middle bi bi-box-arrow-right me-1"></i> Log out
                    </a>
                    <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>
</nav>
