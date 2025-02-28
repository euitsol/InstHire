<header class="header">
    <nav class="navbar navbar-expand-lg">
        <div class="px-0 container-fluid">
            <!-- Mobile Menu Toggle -->
            <button class="btn btn-link d-lg-none me-3 text-dark fs-4" id="sidebarToggle">
                <i class="bi bi-list"></i>
            </button>

            <!-- Brand -->
            <a class="navbar-brand d-flex align-items-center" href="javascript:void(0)">
                <span class="brand-text ms-2">InstHire</span>
            </a>

            <!-- Spacer for right alignment -->
            <div class="flex-grow-1"></div>

            <!-- User Dropdown -->
            <div class="dropdown">
                <a href="javascript:void(0)" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">

                        <img src="{{  student()->image }}" class="avatar-circle" alt="{{ student()->name }}" />
                    <span class="d-none d-sm-inline ms-2">{{ student()->name }}</span>
                </a>
                <ul class="shadow-sm dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li>
                        <a class="dropdown-item" href="{{ route('student.profile.index') }}">
                            <i class="bi bi-person me-2"></i>Profile
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item text-danger" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                        </a>
                        <form id="logout-form" action="{{ route('student.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
