$(document).ready(function() {
    // Sidebar Toggle
    $('#sidebarToggle').on('click', function() {
        $('.sidebar').toggleClass('active');
        $('.content-wrapper').toggleClass('active');
    });

    // Responsive sidebar
    $(window).resize(function() {
        if ($(window).width() <= 768) {
            $('.sidebar').removeClass('active');
        } else {
            $('.sidebar').addClass('active');
        }
    });

    // Initialize all dropdowns
    var dropdownElementList = [].slice.call(document.querySelectorAll('.dropdown-toggle'));
    var dropdownList = dropdownElementList.map(function (dropdownToggleEl) {
        return new bootstrap.Dropdown(dropdownToggleEl);
    });

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

    // Responsive navigation
    $('.nav-toggle').on('click', function() {
        $('.nav-menu').toggleClass('is-active');
    });
});
