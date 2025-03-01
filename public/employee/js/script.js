// Initialize tooltips and popovers
document.addEventListener('DOMContentLoaded', function() {
    // Theme Management
    const themeToggler = document.getElementById('themeToggler');
    if (themeToggler) {
        // Get system theme preference
        const prefersDarkScheme = window.matchMedia('(prefers-color-scheme: dark)');
        
        // Function to update theme
        function updateTheme(theme) {
            const html = document.documentElement;
            html.setAttribute('data-bs-theme', theme);
            
            // Update icon
            const icon = themeToggler.querySelector('i');
            icon.classList.remove('bi-sun', 'bi-moon');
            icon.classList.add(theme === 'dark' ? 'bi-sun' : 'bi-moon');
            
            // Store theme preference
            localStorage.setItem('theme', theme);
        }

        // Function to sync theme with server
        function syncThemeWithServer(theme) {
            fetch('/employee/theme', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ theme: theme })
            });
        }

        // Initialize theme
        const storedTheme = localStorage.getItem('theme');
        const initialTheme = storedTheme || (prefersDarkScheme.matches ? 'dark' : 'light');
        updateTheme(initialTheme);
        syncThemeWithServer(initialTheme);

        // Listen for system theme changes
        prefersDarkScheme.addEventListener('change', (e) => {
            const newTheme = e.matches ? 'dark' : 'light';
            updateTheme(newTheme);
            syncThemeWithServer(newTheme);
        });

        // Handle manual theme toggle
        themeToggler.addEventListener('click', function() {
            const currentTheme = document.documentElement.getAttribute('data-bs-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            updateTheme(newTheme);
            syncThemeWithServer(newTheme);
        });
    }

    // Mobile Sidebar Toggle
    const sidebarToggler = document.getElementById('sidebarToggler');
    const sidebarClose = document.getElementById('sidebarClose');
    const sidebar = document.querySelector('.sidebar');
    const backdrop = document.getElementById('sidebarBackdrop');

    if (sidebarToggler && sidebar && backdrop) {
        sidebarToggler.addEventListener('click', toggleSidebar);
        sidebarClose.addEventListener('click', toggleSidebar);
        backdrop.addEventListener('click', toggleSidebar);
    }

    function toggleSidebar() {
        sidebar.classList.toggle('show');
        backdrop.classList.toggle('d-none');
        document.body.classList.toggle('sidebar-open');

        // Prevent scrolling when sidebar is open on mobile
        if (sidebar.classList.contains('show')) {
            document.body.style.overflow = 'hidden';
        } else {
            document.body.style.overflow = '';
        }
    }

    // Initialize Bootstrap Tooltips
    const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    tooltips.forEach(tooltip => new bootstrap.Tooltip(tooltip));

    // Initialize Bootstrap Dropdowns
    const dropdowns = document.querySelectorAll('.dropdown-toggle');
    dropdowns.forEach(dropdown => new bootstrap.Dropdown(dropdown));

    // Initialize Bootstrap Collapse for Submenus
    const submenus = document.querySelectorAll('.submenu');
    submenus.forEach(submenu => new bootstrap.Collapse(submenu, { toggle: false }));

    // Keep parent submenu open if child is active
    const activeSubmenuItems = document.querySelectorAll('.submenu .nav-link.active');
    activeSubmenuItems.forEach(item => {
        const parentSubmenu = item.closest('.submenu');
        if (parentSubmenu) {
            parentSubmenu.classList.add('show');
            const parentToggle = document.querySelector(`[data-bs-toggle="collapse"][href="#${parentSubmenu.id}"]`);
            if (parentToggle) {
                parentToggle.classList.remove('collapsed');
                parentToggle.setAttribute('aria-expanded', 'true');
            }
        }
    });

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
