$(document).ready(function () {
    const $selectAll = $('#select_all');
    const $checkboxes = $('input[name="permissions[]"]').not('#select_all');

    function refreshSelectAllState() {
        const total = $checkboxes.length;
        const checked = $checkboxes.filter(':checked').length;

        $selectAll.prop('checked', checked === total);
        $selectAll.prop('indeterminate', checked > 0 && checked < total);
    }

    // Toggle all when Select All is clicked
    $selectAll.on('change', function () {
        $checkboxes.prop('checked', $(this).prop('checked'));
        $selectAll.prop('indeterminate', false);
    });

    // Update Select All when any checkbox changes
    $checkboxes.on('change', function () {
        refreshSelectAllState();
    });

    // Initialize state on page load
    refreshSelectAllState();

    document.addEventListener('DOMContentLoaded', function () {
        const forms = document.querySelectorAll('form');

        forms.forEach(form => {
            form.addEventListener('submit', function () {
                const submitBtn = form.querySelector('.submit-btn');
                const submitText = form.querySelector('.submit-text');
                const submitSpinner = form.querySelector('.submit-spinner');

                if (submitBtn && submitSpinner && submitText) {
                    submitBtn.disabled = true;
                    submitSpinner.classList.remove('d-none');
                    submitText.textContent = 'Please wait...';
                }
            });
        });
    });
});

