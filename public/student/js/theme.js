$(document).ready(function() {
    // Sidebar Toggle
    $('.sidebar-toggle').on('click', function() {
        $('.sidebar').toggleClass('active');
        $('.main').toggleClass('active');
    });

    // Responsive sidebar
    $(window).resize(function() {
        if ($(window).width() <= 768) {
            $('.sidebar').removeClass('active');
        } else {
            $('.sidebar').addClass('active');
        }
    });

    // Dropdown menus
    $('.dropdown-toggle').dropdown();

    // Tooltips
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

    // Card animations
    $('.card').hover(
        function() { $(this).addClass('shadow-lg'); },
        function() { $(this).removeClass('shadow-lg'); }
    );

    // Smooth scrolling
    $('a[href*="#"]').on('click', function(e) {
        e.preventDefault();
        $('html, body').animate(
            {
                scrollTop: $($(this).attr('href')).offset().top,
            },
            500,
            'linear'
        );
    });

    // Progress bar animation
    function animateProgressBars() {
        $('.progress-bar').each(function() {
            const width = $(this).data('progress') + '%';
            $(this).css('width', width);
        });
    }

    // Animate on scroll
    $(window).scroll(function() {
        $('.fade-in').each(function() {
            const elementTop = $(this).offset().top;
            const elementBottom = elementTop + $(this).outerHeight();
            const viewportTop = $(window).scrollTop();
            const viewportBottom = viewportTop + $(window).height();

            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('visible');
            }
        });
    });

    // Initialize animations
    animateProgressBars();

    // Chart animations (if using charts)
    if (typeof Chart !== 'undefined') {
        Chart.defaults.animation.duration = 2000;
        Chart.defaults.animation.easing = 'easeInOutQuart';
    }

    // Custom alert dismissal
    $('.alert-dismissible').on('click', '.close', function() {
        $(this).closest('.alert').fadeOut(300, function() {
            $(this).remove();
        });
    });

    // Form validation styles
    $('form').on('submit', function() {
        $(this).addClass('was-validated');
    });

    // Dynamic table search
    $('#tableSearch').on('keyup', function() {
        const value = $(this).val().toLowerCase();
        $('.table tbody tr').filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });

    // Responsive navigation
    $('.nav-toggle').on('click', function() {
        $('.nav-menu').toggleClass('is-active');
    });
});
