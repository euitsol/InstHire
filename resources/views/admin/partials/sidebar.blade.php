<nav class="sidebar">
    <div class="d-flex align-items-center justify-content-between">
        <h2 class="h4 ps-2 m-0">JobHub</h2>
        <button class="sidebar-toggle text-white">
            <i class="bi bi-x"></i>
        </button>
    </div>
    <ul class="nav flex-column">
        <li class="nav-item mb-2">
            <a href="{{ route('admin.dashboard') }}" class="nav-link {{ $page_slug === 'dashboard' ? 'active' : '' }}">
                <i class="bi bi-house-door me-2"></i> {{ __('Dashboard') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ $page_slug === 'admin' ? 'active' : 'collapsed' }}" href="#"
                data-bs-toggle="collapse" data-bs-target="#adminSubmenu"
                aria-expanded="{{ $page_slug === 'admin' ? 'true' : 'false' }}">
                <i class="bi bi-person-badge me-2"></i>
                {{ __('Admin Management') }}
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul class="collapse {{ $page_slug === 'admin' ? 'show' : '' }}" id="adminSubmenu">
                <li class="nav-item">
                    <a class="nav-link {{ $page_slug === 'admin' ? 'active' : '' }}"
                        href="{{ route('am.admin.index') }}">
                        {{ __('Admin') }}
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $page_slug === 'subscription' ? 'active' : 'collapsed' }}" href="#"
                data-bs-toggle="collapse" data-bs-target="#subsSubmenu"
                aria-expanded="{{ $page_slug === 'subscription' ? 'true' : 'false' }}">
                <i class="bi bi-person-badge me-2"></i>
                {{ __('Subscription Management') }}
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul class="collapse {{ $page_slug === 'subscription' ? 'show' : '' }}" id="subsSubmenu">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('sm.subscription.*') ? 'active' : '' }}"
                        href="{{ route('sm.subscription.index') }}">
                        <i class="bi bi-tag me-2"></i>
                        <span>{{ __('Subscriptions') }}</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('sm.institute-subscription.*') ? 'active' : '' }}"
                        href="{{ route('sm.institute-subscription.index') }}">
                        <i class="bi bi-building me-2"></i>
                        <span>{{ __('Institute Subscriptions') }}</span>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $page_slug === 'job-category' ? 'active' : 'collapsed' }}" href="#"
                data-bs-toggle="collapse" data-bs-target="#jobCategorySubmenu"
                aria-expanded="{{ $page_slug === 'job-category' ? 'true' : 'false' }}">
                <i class="bi bi-briefcase me-2"></i>
                {{ __('Job Management') }}
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul class="collapse {{ $page_slug === 'job-category' ? 'show' : '' }}" id="jobCategorySubmenu">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('jc.job-category.*') ? 'active' : '' }}"
                        href="{{ route('jc.job-category.index') }}">
                        <i class="bi bi-tags me-2"></i>
                        <span>{{ __('Job Categories') }}</span>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
