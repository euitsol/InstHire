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
            <a class="nav-link {{ $page_slug === 'subscription' || $page_slug === 'institute-subscription' ? 'active' : 'collapsed' }}" href="#"
                data-bs-toggle="collapse" data-bs-target="#subsSubmenu"
                aria-expanded="{{ $page_slug === 'subscription' || $page_slug === 'institute-subscription' ? 'true' : 'false' }}">
                <i class="bi bi-person-badge me-2"></i>
                {{ __('Subscription Management') }}
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul class="collapse {{ $page_slug === 'subscription' || $page_slug === 'institute-subscription' ? 'show' : '' }}" id="subsSubmenu">
                <li class="nav-item">
                    <a class="nav-link {{ $page_slug === 'subscription' ? 'active' : '' }}"
                        href="{{ route('sm.subscription.index') }}">
                        {{ __('Subscriptions') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ $page_slug === 'institute-subscription' ? 'active' : '' }}"
                        href="{{ route('sm.institute-subscription.index') }}">
                        {{ __('Institute Subscriptions') }}
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
                    <a class="nav-link {{ $page_slug === 'job-category' ? 'active' : '' }}"
                        href="{{ route('jc.job-category.index') }}">
                        {{ __('Job Categories') }}
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ $page_slug === 'payment' ? 'active' : 'collapsed' }}" href="#"
                data-bs-toggle="collapse" data-bs-target="#paymentSubmenu"
                aria-expanded="{{ $page_slug === 'payment' ? 'true' : 'false' }}">
                <i class="bi bi-credit-card me-2"></i>
                {{ __('Payment Management') }}
                <i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul class="collapse {{ $page_slug === 'payment' ? 'show' : '' }}" id="paymentSubmenu">
                <li class="nav-item">
                    <a class="nav-link {{ $page_slug === 'payment' ? 'active' : '' }}"
                        href="{{ route('pm.payment.index') }}">
                        {{ __('Payments') }}
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</nav>
