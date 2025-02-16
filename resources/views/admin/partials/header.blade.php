<nav class="navbar navbar-expand-lg navbar-light sticky-top">
    <div class="container-fluid">
        <!-- Sidebar Toggle Button -->
        <div class="d-flex align-items-center justify-content-between justify-content-lg-end w-100">
            @if (Auth::guard('admin')->check())
                <button class="sidebar-toggle">
                    <i class="bi bi-list"></i>
                </button>
                <div class="dropdown">
                    <button class="btn p-0" type="button" id="userDropdown" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <img src="{{ asset('storage/' . Auth::guard('admin')->user()->image) ?? 'https://i.pravatar.cc/150?img=68' }}"
                            alt="User Avatar" class="user-avatar">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li>
                            <h6 class="dropdown-header">{{ Auth::guard('admin')->user()->name }}</h6>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('am.admin.profile') }}"><i
                                    class="bi bi-person me-2"></i>{{ __('My Profile') }}</a>
                        </li>
                        <li><a class="dropdown-item" href="{{ route('admin.logout') }}"
                                onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();"><i
                                    class="bi bi-box-arrow-right me-2"></i>{{ __('Logout') }}</a>
                        </li>
                    </ul>

                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            @else
                <a href="admin.login" class="btn-login me-3">{{ __('Login') }}</a>
            @endif
        </div>
    </div>
</nav>
