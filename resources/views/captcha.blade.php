(function () {
    const captchaDOM = `
        <fieldset class="form-label-group form-group position-relative has-icon-left dcat-login-captcha">
            <input id="captcha" class="form-control" type="text" style="width: 61%;" name="captcha" placeholder="{{ \Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider::trans('login-captcha.captcha') }}" required>
            <span class="captcha-img" style="width: 37%;height: 33.5px;position: absolute;top: 0;right: 0;border-radius: .25rem;border: 1px solid #dbe3e6;">
                <img id="verify" class="captcha" src="{{ login_captcha_url() }}" data-src="{{ login_captcha_url() }}" alt="{{ \Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider::trans('login-captcha.captcha') }}" title="{{ \Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider::trans('login-captcha.refresh_captcha') }}" style="cursor: pointer;width: 100%;height: 100%;border-radius: .25rem;">
            </span>
            <div class="form-control-position"><i class="feather icon-image"></i></div>
            <label for="captcha">{{ \Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider::trans('login-captcha.captcha') }}</label>
            <div class="help-block with-errors"></div>
        </fieldset>
    `;

    $(captchaDOM).insertAfter($('#login-form fieldset.form-label-group').get(1));

    $('#verify').click(function () {
        $(this).attr('src', $(this).data('src').replace(/\?.*$/, '') + '?' + Math.random());
    });

    $('.dcat-login-captcha .with-errors').bind('DOMNodeInserted', function () {
        if ($('#captcha').val() !== '' && $(this).html().length > 0) {
            $("#verify").trigger("click");
        }
    });
})();
