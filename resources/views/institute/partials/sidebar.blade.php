<div class="sidebar">
    <div class="sidebar-header">
        <h4 class="mb-0">{{ config('app.name') }}</h4>
    </div>
    
    <div class="sidebar-menu">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{ route('institute.dashboard') }}" class="nav-link {{ request()->routeIs('institute.dashboard') ? 'active' : '' }}">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('institute.profile') }}" class="nav-link {{ request()->routeIs('institute.profile') ? 'active' : '' }}">
                    <i class="fas fa-user"></i>
                    <span>Profile</span>
                </a>
            </li>
            <!-- Add more menu items here -->
        </ul>
    </div>
</div>
