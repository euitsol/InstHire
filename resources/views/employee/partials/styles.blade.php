<!-- Custom CSS -->
<style>
    :root {
        --sidebar-width: 280px;
        --header-height: 70px;
        --primary-color: #0d6efd;
        --secondary-color: #6c757d;
        --success-color: #198754;
        --info-color: #0dcaf0;
        --warning-color: #ffc107;
        --danger-color: #dc3545;
        --light-color: #f8f9fa;
        --dark-color: #212529;
    }

    /* Scrollbar Styles */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: var(--light-color);
    }

    ::-webkit-scrollbar-thumb {
        background: var(--secondary-color);
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: var(--primary-color);
    }

    /* Layout */
    body {
        min-height: 100vh;
        overflow-x: hidden;
    }

    #app {
        display: flex;
        min-height: 100vh;
    }

    .sidebar {
        width: var(--sidebar-width);
        min-height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        z-index: 1000;
        transition: all 0.3s ease;
    }

    .main-content {
        flex: 1;
        margin-left: var(--sidebar-width);
        min-height: 100vh;
        transition: all 0.3s ease;
    }

    .content-wrapper {
        padding: 2rem;
        min-height: calc(100vh - var(--header-height));
    }

    /* Header */
    .navbar {
        height: var(--header-height);
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    /* Cards */
    .card {
        border-radius: 0.5rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Buttons */
    .btn {
        border-radius: 0.375rem;
        padding: 0.5rem 1rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: var(--primary-color);
        border-color: var(--primary-color);
    }

    .btn-primary:hover {
        background: darken(var(--primary-color), 10%);
        border-color: darken(var(--primary-color), 10%);
    }

    /* Tables */
    .table {
        margin-bottom: 0;
    }

    .table th {
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 0.5px;
    }

    /* Stats Cards */
    .stats-card {
        border: none;
        background: linear-gradient(45deg, var(--primary-color), darken(var(--primary-color), 15%));
        color: white;
    }

    .stats-card .card-body {
        padding: 1.5rem;
    }

    .stats-icon {
        font-size: 2rem;
        opacity: 0.8;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .sidebar {
            transform: translateX(-100%);
        }

        .main-content {
            margin-left: 0;
        }

        .sidebar.show {
            transform: translateX(0);
        }
    }
</style>
