<header class="header fixed-top">
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <span class="brand-text">Inst<span class="text-primary">Hire</span></span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('frontend.jobs') ? 'active' : '' }}" href="{{ route('frontend.jobs') }}">
                            <i class="bi bi-briefcase me-1"></i>Browse Jobs
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('institute.login') }}">
                            <i class="bi bi-building me-1"></i>For Institutes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="bi bi-building-check me-1"></i>For Employers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#job-fairs">
                            <i class="bi bi-calendar-event me-1"></i>Job Fairs
                        </a>
                    </li>
                    <li class="nav-item ms-lg-3">
                        @if(student())
                        <a class="btn btn-primary" href="{{ route('student.dashboard') }}">
                            <i class="bi bi-person me-1"></i>Dashboard
                        </a>
                        @else
                        <a class="btn btn-primary" href="{{ route('student.register') }}">
                            <i class="bi bi-person-plus me-1"></i>Sign Up
                        </a>
                        @endIf
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
