// Initialize tooltips and popovers
document.addEventListener('DOMContentLoaded', function() {
    // Theme Toggler
    const themeToggler = document.getElementById('themeToggler');
    if (themeToggler) {
        themeToggler.addEventListener('click', function() {
            const html = document.documentElement;
            const currentTheme = html.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            
            html.setAttribute('data-bs-theme', newTheme);
            localStorage.setItem('theme', newTheme);

            // Update icon
            const icon = this.querySelector('i');
            icon.classList.toggle('bi-sun');
            icon.classList.toggle('bi-moon');

            // Send theme preference to server
            fetch('/employee/theme', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ theme: newTheme })
            });
        });
    }

    // Mobile Sidebar Toggle
    const sidebarToggler = document.getElementById('sidebarToggler');
    const sidebar = document.querySelector('.sidebar');
    const backdrop = document.getElementById('sidebarBackdrop');

    if (sidebarToggler && sidebar && backdrop) {
        sidebarToggler.addEventListener('click', toggleSidebar);
        backdrop.addEventListener('click', toggleSidebar);
    }

    function toggleSidebar() {
        sidebar.classList.toggle('show');
        backdrop.classList.toggle('d-none');
        document.body.classList.toggle('sidebar-open');
    }

    // Initialize Bootstrap Tooltips
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(tooltip => new bootstrap.Tooltip(tooltip));

    // Initialize Bootstrap Dropdowns
    const dropdowns = document.querySelectorAll('.dropdown-toggle');
    dropdowns.forEach(dropdown => new bootstrap.Dropdown(dropdown));

    // Initialize Bootstrap Popovers
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function(popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // File input functionality
    const fileInputs = document.querySelectorAll('.custom-file-input');
    fileInputs.forEach(input => {
        input.addEventListener('change', function() {
            const fileName = this.files[0]?.name;
            const label = this.nextElementSibling;
            if (label) {
                label.textContent = fileName || 'Choose file';
            }
        });
    });

    // Form validation
    const forms = document.querySelectorAll('.needs-validation');
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });

    // Alert functionality
    window.showAlert = function(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show d-flex align-items-center`;
        alertDiv.setAttribute('role', 'alert');
        alertDiv.setAttribute('data-auto-dismiss', '');
        
        // Add appropriate icon based on alert type
        let icon;
        switch (type) {
            case 'success':
                icon = 'bi-check-circle-fill';
                break;
            case 'danger':
            case 'error':
                icon = 'bi-x-circle-fill';
                break;
            case 'warning':
                icon = 'bi-exclamation-triangle-fill';
                break;
            case 'info':
                icon = 'bi-info-circle-fill';
                break;
            default:
                icon = 'bi-info-circle-fill';
        }
        
        alertDiv.innerHTML = `
            <i class="bi ${icon} me-2 fs-5"></i>
            <div>${message}</div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        // Find or create alerts container
        let alertsContainer = document.querySelector('.alerts-container');
        if (!alertsContainer) {
            alertsContainer = document.createElement('div');
            alertsContainer.className = 'alerts-container position-fixed top-0 end-0 p-3';
            alertsContainer.style.zIndex = '1080';
            document.body.appendChild(alertsContainer);
        }
        
        alertsContainer.appendChild(alertDiv);
        
        // Auto dismiss after 5 seconds
        setTimeout(() => {
            alertDiv.classList.add('fade');
            setTimeout(() => alertDiv.remove(), 150);
        }, 5000);
    };

    // Handle server-side alerts
    const alerts = document.querySelectorAll('.alert[data-auto-dismiss]');
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 150);
        }, 5000);
    });
});
