@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert" data-auto-dismiss>
        <i class="bi bi-check-circle-fill me-2 fs-5"></i>
        <div>
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show d-flex align-items-center mb-4" role="alert" data-auto-dismiss>
        <i class="bi bi-x-circle-fill me-2 fs-5"></i>
        <div>
            {{ session('error') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('warning'))
    <div class="alert alert-warning alert-dismissible fade show d-flex align-items-center mb-4" role="alert" data-auto-dismiss>
        <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i>
        <div>
            {{ session('warning') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('info'))
    <div class="alert alert-info alert-dismissible fade show d-flex align-items-center mb-4" role="alert" data-auto-dismiss>
        <i class="bi bi-info-circle-fill me-2 fs-5"></i>
        <div>
            {{ session('info') }}
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
