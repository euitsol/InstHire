<nav class="sidebar">
    <h2 class="h4 mb-4 ps-2">JobHub</h2>
    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $page_slug === 'dashboard' ? 'active' : '' }}">
                <i class="bi bi-house-door me-2"></i> {{ __('Dashboard') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $page_slug === 'admin' ? 'active' : 'collapsed' }}" href="#" data-bs-toggle="collapse" data-bs-target="#adminSubmenu" aria-expanded="{{ $page_slug === 'admin' ? 'true' : 'false' }}">
                <i class="bi bi-person-badge me-2"></i>
                {{ __('Admin Management') }}
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul class="collapse {{ $page_slug === 'admin' ? 'show' : '' }}" id="adminSubmenu">
                <li class="nav-item">
                    <a class="nav-link {{ $page_slug === 'admin' ? 'active' : '' }}" href="{{ route('am.admin.index') }}">
                        {{__('Admin')}}
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
