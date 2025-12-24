let currentRole = 'official';

function setRole(role) {
    currentRole = role;

    const officialBtn = document.getElementById('officialBtn');
    const farmerBtn = document.getElementById('farmerBtn');
    const username = document.getElementById('username');
    const createBtn = document.getElementById('createBtn');
    const form = $('#loginForm');

    clearErrors();

    if (role === 'official') {
        // UI
        officialBtn.classList.add('active');
        farmerBtn.classList.remove('active');

        // Input reset
        username.type = 'text';
        username.name = 'username';
        username.placeholder = 'Insert User ID / Email';
        username.value = '';
        // ❌ REMOVE mobile validation
        username.removeAttribute('maxlength');
        username.removeAttribute('inputmode');
        username.removeAttribute('pattern');
        username.oninput = null;

        // Form action
        // form.attr('action', "{{ route('account.login.submit') }}");
        form.attr('action', window.APP.loginRoutes.official);

        createBtn.classList.add('d-none');

    } else {
        // UI
        farmerBtn.classList.add('active');
        officialBtn.classList.remove('active');

        // Input reset
        username.type = 'tel';
        username.name = 'phone';
        username.placeholder = 'Insert Registered Mobile Number';
        username.value = '';

        // Mobile validation
        username.setAttribute('maxlength', '10');
        username.setAttribute('inputmode', 'numeric');
        username.setAttribute('pattern', '[0-9]{10}');

        username.oninput = function () {
            this.value = this.value.replace(/\D/g, '').slice(0, 10);
        };

        // Form action
        // form.attr('action', "{{ route('login') }}");
        form.attr('action', window.APP.loginRoutes.farmer);

        createBtn.classList.remove('d-none');
    }
}


function reloadCaptcha() {
    // alert(1);
    document.getElementById('captchaImage').src =
        window.APP.captchaUrl + '?' + Date.now();
}


$('#loginForm').on('submit', function (e) {
    e.preventDefault();
    clearErrors();

    $.ajax({
        url: $(this).attr('action'),
        type: "POST",
        data: $(this).serialize(),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            $("#submitBtn").attr('disabled', true);
        },
        success: function (res) {
            if (res.status) {
                // BOTH farmer & admin handled here
                window.location.href = res.redirect;
            }
        },

        error: function (xhr) {
            let res = xhr.responseJSON;

            if (res?.errors) {
                $("#submitBtn").attr('disabled', false);
                $.each(res.errors, function (field, messages) {
                    let input = $('[name="' + field + '"]');
                    input.addClass('is-invalid');
                    input.next('.invalid-feedback').text(messages[0]);
                });

                iziToast.error({
                    title: 'Error',
                    message: 'Please fix the highlighted errors',
                    position: 'topRight'
                });

            } else {
                $("#submitBtn").attr('disabled', false);
                iziToast.error({
                    title: 'Error',
                    message: res?.message || 'Login failed',
                    position: 'topRight'
                });

            }

            reloadCaptcha();
        }
    });
});

function clearErrors() {
    $('#loginForm .is-invalid').removeClass('is-invalid');
    $('#loginForm .invalid-feedback').text('');
}

$('#loginForm input').on('input', function () {
    $(this).removeClass('is-invalid');
    $(this).next('.invalid-feedback').text('');
});
