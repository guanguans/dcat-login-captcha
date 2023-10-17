(function () {
const captchaDOM = `
<fieldset class="form-label-group form-group position-relative has-icon-left" id="captcha">
    <input
        class="form-control" id="captcha-input" name="captcha"
        placeholder="{{ Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider::trans('login-captcha.captcha') }}"
        required style="width: 61%;"
        type="text"
    >
    <span style="width: 37%;height: 33.5px;position: absolute;top: 0;right: 0;border-radius: .25rem;border: 1px solid #dbe3e6;">
        <img
            alt="{{ Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider::trans('login-captcha.captcha') }}"
            id="captcha-img"
            src="{{ login_captcha_url() }}"
            style="cursor: pointer;width: 100%;height: 100%;border-radius: .25rem;"
            title="{{ Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider::trans('login-captcha.refresh_captcha') }}"
        >
    </span>
    <div class="form-control-position"><i class="feather icon-image"></i></div>
    <label for="captcha-input">{{ Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider::trans('login-captcha.captcha') }}</label>
    <div class="help-block with-errors"></div>
</fieldset>
`;

$(captchaDOM).insertAfter($('#login-form fieldset.form-label-group').get(1));

$('#captcha-img').click(function () {
    $(this).attr('src', $(this).attr('src').replace(/\?random=.*$/, '?random=' + Math.random()));
});

$('#captcha .with-errors').bind('DOMNodeInserted', function () {
    if ($('#captcha-input').val() !== '' && $(this).html().length > 0) {
        $("#captcha-img").trigger("click");
    }
});
})();
