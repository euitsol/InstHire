//Select 2
$(document).ready(function () {
    // Initialize Select2
    // $("select.form-control:not(.no-select)").select2();

    // Sidebar Toggle Functionality
    var $sidebar = $('.sidebar');
    var $sidebarToggle = $('.sidebar-toggle');
    var $sidebarBackdrop = $('.sidebar-backdrop');
    var $body = $('body');

    function toggleSidebar() {
        $sidebar.toggleClass('show');
        $sidebarBackdrop.toggleClass('show');
        $body.toggleClass('sidebar-open');
    }

    // Toggle sidebar on button click
    $sidebarToggle.on('click', function (e) {
        e.preventDefault();
        toggleSidebar();
    });

    // Close sidebar when clicking backdrop
    $sidebarBackdrop.on('click', toggleSidebar);

    // Close sidebar on window resize if screen becomes large
    $(window).on('resize', function () {
        if ($(window).width() >= 992 && $sidebar.hasClass('show')) {
            toggleSidebar();
        }
    });

    // Handle submenu toggles
    $('[data-bs-toggle="collapse"]').on('click', function (e) {
        var $submenu = $($(this).attr('data-bs-target'));
        if ($submenu.length) {
            e.preventDefault();
            $submenu.toggleClass('show');
            $(this).toggleClass('collapsed');
            $(this).attr('aria-expanded', $submenu.hasClass('show'));
        }
    });
});

// Slug Generator
function generateSlug(str) {
    return str
        .toLowerCase()
        .replace(/\s+/g, "-")
        .replace(/[^\w\u0980-\u09FF-]+/g, "") // Allow Bangla characters (\u0980-\u09FF)
        .replace(/--+/g, "-")
        .replace(/^-+|-+$/g, "");
}

$(document).ready(function () {
    $("#title").on("keyup", function () {
        const titleValue = $(this).val().trim();
        const slugValue = generateSlug(titleValue);
        $("#slug").val(slugValue);
    });
});
