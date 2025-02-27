document.addEventListener('DOMContentLoaded', function() {
    // Password toggle functionality
    const passwordToggles = document.querySelectorAll('.password-toggle-btn');
    
    passwordToggles.forEach(toggle => {
        toggle.addEventListener('click', function() {
            const input = this.previousElementSibling;
            const icon = this.querySelector('i');
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');
            }
        });
    });

    // Institute and Department dependent dropdown
    const instituteSelect = document.getElementById('institute_id');
    const departmentSelect = document.getElementById('department_id');

    if (instituteSelect && departmentSelect) {
        instituteSelect.addEventListener('change', function() {
            const instituteId = this.value;
            if (instituteId) {
                fetch(`/api/institutes/${instituteId}/departments`)
                    .then(response => response.json())
                    .then(data => {
                        departmentSelect.innerHTML = '<option value="">Select Department</option>';
                        data.forEach(dept => {
                            departmentSelect.innerHTML += `
                                <option value="${dept.id}">${dept.name}</option>
                            `;
                        });
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                departmentSelect.innerHTML = '<option value="">Select Department</option>';
            }
        });
    }

    // Form validation
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
});
