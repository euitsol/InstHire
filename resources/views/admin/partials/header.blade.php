<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container-fluid">
        <a class="navbar-brand text-secondary fw-bold" href="#">Admin Dashboard</a>
        <form class="d-flex search-form mx-auto">
            <input class="form-control me-2" type="search" placeholder="Search jobs..." aria-label="Search">
            <button class="btn" type="submit"><i class="bi bi-search"></i></button>
        </form>
        <div class="d-flex align-items-center">
            @if (Auth::guard('admin')->check())
                <button class="btn me-2"><i class="bi bi-bell"></i></button>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="userDropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="https://i.pravatar.cc/150?img=68" alt="User Avatar" class="user-avatar">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <h6 class="dropdown-header">Alex Johnson</h6>
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>My
                                Profile</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Settings</a>
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-briefcase me-2"></i>My
                                Applications</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-question-circle me-2"></i>Help
                                Center</a></li>
                        <li><a class="dropdown-item" href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();"><i
                                    class="bi bi-box-arrow-right me-2"></i>Logout</a>
                        </li>
                    </ul>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @else
                <a href="admin.login" class="btn-login me-3">Login</a>
            @endif
        </div>
    </div>
</nav>
