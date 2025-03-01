/**
 * Job Details Page JavaScript
 */

$(document).ready(function() {
    // Initialize AOS
    AOS.init({
        duration: 800,
        once: true
    });

    // Initialize apply job button
    $('#applyJobBtn').on('click', function() {
        $('#applyJobModal').modal('show');
    });

    // File upload preview
    const $cvUpload = $('#cvUpload');
    const $uploadZone = $('.upload-zone');
    const $selectedFileName = $('#selectedFileName');

    // Drag and drop functionality
    $uploadZone.on('dragover', function(e) {
        e.preventDefault();
        $(this).addClass('bg-light');
    });

    $uploadZone.on('dragleave', function(e) {
        e.preventDefault();
        $(this).removeClass('bg-light');
    });

    $uploadZone.on('drop', function(e) {
        e.preventDefault();
        $(this).removeClass('bg-light');

        if ($cvUpload.length) {
            $cvUpload[0].files = e.originalEvent.dataTransfer.files;

            if ($cvUpload[0].files.length > 0) {
                $selectedFileName.text($cvUpload[0].files[0].name);

                // If a file is selected, clear the previous CV dropdown
                $('#previousCvs').val('');
            }
        }
    });

    // File input change event
    $cvUpload.on('change', function() {
        if (this.files.length > 0) {
            $selectedFileName.text(this.files[0].name);

            // If a file is selected, clear the previous CV dropdown
            $('#previousCvs').val('');
        }
    });

    // Previous CV selection
    $('#previousCvs').on('change', function() {
        if ($(this).val()) {
            $cvUpload.val('');
            $selectedFileName.text('');
        }
    });

    // Form validation and submission
    $('#applyJobForm').on('submit', function(e) {
        e.preventDefault();

        console.log('clicked');

        // Bootstrap validation
        if (!this.checkValidity()) {
            e.stopPropagation();
            $(this).addClass('was-validated');
            return;
        }

        console.log('valid');

        // Check if at least one CV option is selected
        const previousCvSelected = $('#previousCvs').val();
        const newCvSelected = $cvUpload[0] && $cvUpload[0].files.length > 0;

        if (!previousCvSelected && !newCvSelected) {
            alert('Please select a previous CV or upload a new one');
            return;
        }

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function() {
                console.log('sending');

                // Show loading state
                $('.progress-bar').css({
                    'width': '100%',
                    'transition': 'width 1s ease-in-out'
                });
                $('#applyJobForm button[type="submit"]').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Submitting...');
            },
            success: function(response) {
                console.log(response);

                // Reset form and show success message
                $('#applyJobForm')[0].reset();
                $('.progress-bar').css('width', '0');

                // Show success alert with fade
                $('<div class="alert alert-success alert-dismissible fade show" role="alert">')
                    .html('Your application has been submitted successfully! We will contact you soon.<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>')
                    .insertBefore('#applyJobForm')
                    .hide()
                    .fadeIn();

                // Close modal after 2 seconds
                setTimeout(function() {
                    $('#applyJobModal').modal('hide');
                }, 1000);

                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "Your application has been submitted successfully! We will contact you soon.",
                    timer: 3000,
                    showConfirmButton: false
                });

                window.location.reload();
            },
            error: function(xhr) {
                console.log(xhr);

                // Reset progress
                $('.progress-bar').css('width', '0');

                // Show error messages
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    let errorHtml = '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                    errorHtml += '<ul class="mb-0">';
                    Object.values(xhr.responseJSON.errors).forEach(function(error) {
                        errorHtml += '<li>' + error[0] + '</li>';
                    });
                    errorHtml += '</ul>';
                    errorHtml += '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';

                    $(errorHtml)
                        .insertBefore('#applyJobForm')
                        .hide()
                        .fadeIn();
                }
            },
            complete: function() {
                console.log('complete');
                // Reset button state
                $('#applyJobForm button[type="submit"]').prop('disabled', false).html('Submit Application');
            }
        });
    });
});

// CV Tab Management
$(document).ready(function() {
    // Initialize the CV tabs
    const cvTabs = {
        upload: document.querySelector('.cv-upload-container'),
        select: document.querySelector('#previousCvsSection')
    };

    // Handle file upload
    const uploadInput = document.getElementById('cvUpload');
    const uploadZone = document.querySelector('.upload-zone');

    // Drag and drop functionality
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, preventDefaults, false);
    });

    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    ['dragenter', 'dragover'].forEach(eventName => {
        uploadZone.addEventListener(eventName, () => {
            uploadZone.classList.add('highlight');
        });
    });

    ['dragleave', 'drop'].forEach(eventName => {
        uploadZone.addEventListener(eventName, () => {
            uploadZone.classList.remove('highlight');
        });
    });

    uploadZone.addEventListener('drop', handleDrop);

    function handleDrop(e) {
        const dt = e.dataTransfer;
        const file = dt.files[0];
        uploadInput.files = dt.files;
        validateAndPreviewFile(file);
    }

    uploadInput.addEventListener('change', function(e) {
        validateAndPreviewFile(this.files[0]);
    });

    function validateAndPreviewFile(file) {
        if (!file) return;

        // Validate file type
        const validTypes = ['.pdf', '.doc', '.docx'];
        const fileExtension = '.' + file.name.split('.').pop().toLowerCase();
        if (!validTypes.includes(fileExtension)) {
            toastr.error('Please upload a PDF, DOC, or DOCX file');
            uploadInput.value = '';
            return;
        }

        // Validate file size (5MB)
        if (file.size > 5 * 1024 * 1024) {
            toastr.error('File size must be less than 5MB');
            uploadInput.value = '';
            return;
        }

        // Show file name
        const fileName = document.createElement('p');
        fileName.classList.add('mt-2', 'text-success');
        fileName.textContent = `Selected: ${file.name}`;

        // Remove any existing file name display
        const existingFileName = uploadZone.querySelector('.text-success');
        if (existingFileName) {
            existingFileName.remove();
        }

        uploadZone.appendChild(fileName);
    }
});
