<!-- Bootstrap Bundle with Popper -->
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}

<!-- Custom JavaScript -->
<script>
    // Sidebar Toggle
    document.getElementById('toggleSidebar').addEventListener('click', function() {
        document.getElementById('sidebar').classList.add('show');
        document.getElementById('sidebarBackdrop').classList.remove('d-none');
    });

    document.getElementById('closeSidebar').addEventListener('click', function() {
        document.getElementById('sidebar').classList.remove('show');
        document.getElementById('sidebarBackdrop').classList.add('d-none');
    });

    document.getElementById('sidebarBackdrop').addEventListener('click', function() {
        document.getElementById('sidebar').classList.remove('show');
        this.classList.add('d-none');
    });

    // Dark Mode Toggle
    document.getElementById('darkModeToggle').addEventListener('click', function() {
        document.documentElement.setAttribute('data-bs-theme',
            document.documentElement.getAttribute('data-bs-theme') === 'dark' ? 'light' : 'dark'
        );
    });

    // Flash Messages
    document.addEventListener('DOMContentLoaded', function() {
        @if (session('success'))
            showAlert('success', '{{ session('success') }}');
        @endif

        @if (session('error'))
            showAlert('error', '{{ session('error') }}');
        @endif

        @if (session('warning'))
            showAlert('warning', '{{ session('warning') }}');
        @endif
    });

    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        document.querySelector('main').insertBefore(alertDiv, document.querySelector('main').firstChild);
    }
</script>
