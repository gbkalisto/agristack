
function reloadCaptcha() {
    document.getElementById('captchaImage').src =
        window.APP.captchaUrl + '?' + Date.now();
}
