<header class="header {{ !auth()->guard('employee')->check() ? 'guest-header' : '' }}">
    <div class="container-fluid">
        <div class="row align-items-center" style="height: 64px;">
            <!-- Left -->
            <div class="col">
                @auth('employee')
                    <button type="button" class="btn btn-link text-body p-0 d-lg-none" id="sidebarToggler">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                @else
                    <a href="{{ route('employee.login') }}" class="text-body text-decoration-none">
                        <h4 class="m-0 fw-semibold">{{ config('app.name') }}</h4>
                    </a>
                @endauth
            </div>

            <!-- Right -->
            <div class="col-auto d-flex align-items-center gap-3">
                <!-- Theme Toggler -->
                <button type="button" class="btn btn-link text-body p-0" id="themeToggler" data-bs-toggle="tooltip" data-bs-title="Toggle Theme">
                    <i class="bi {{ session('theme', 'light') === 'dark' ? 'bi-sun' : 'bi-moon' }} fs-5"></i>
                </button>

                @auth('employee')
                    <!-- User Menu -->
                    <div class="dropdown">
                        <button type="button" class="btn btn-link text-body p-0 dropdown-toggle" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false">
                            @if(employee()->image)
                                <img src="{{ auth_storage_url(employee()->image) }}"
                                    alt="{{ employee()->name }}"
                                    class="rounded-circle"
                                    width="32" height="32">
                            @else
                                <div class="avatar-placeholder rounded-circle bg-primary text-white d-flex align-items-center justify-content-center"
                                    style="width: 32px; height: 32px;">
                                    {{ substr(employee()->name, 0, 1) }}
                                </div>
                            @endif
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-header">
                                <h6 class="mb-0">{{ employee()->name }}</h6>
                                <small class="text-muted">Employee</small>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="{{ route('employee.logout') }}" method="POST" class="d-block">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>
                                        Sign Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</header>
