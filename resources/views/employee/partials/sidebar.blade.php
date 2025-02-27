<!-- Sidebar -->
<aside class="sidebar">
    <!-- Logo -->
    <div class="p-3">
        <a href="{{ route('employee.dashboard') }}" class="d-block">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="img-fluid" style="height: 40px;">
        </a>
    </div>

    <!-- Navigation -->
    <div class="flex-grow-1 px-3 py-2">
        <ul class="nav flex-column gap-1">
            <li class="nav-item">
                <a href="{{ route('employee.dashboard') }}" class="nav-link {{ request()->routeIs('employee.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i>
                    Dashboard
                </a>
            </li>
        </ul>
    </div>

    <!-- Footer -->
    <div class="p-3 border-top">
        <form action="{{ route('employee.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-link text-danger w-100 text-start p-2">
                <i class="bi bi-box-arrow-right"></i>
                Sign Out
            </button>
        </form>
    </div>
</aside>
