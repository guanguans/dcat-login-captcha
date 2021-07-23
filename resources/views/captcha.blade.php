(function () {
    var captchaTpl;
    captchaTpl = '<fieldset class="form-label-group form-group position-relative has-icon-left dcat-login-captcha">'
    captchaTpl += '<input id="captcha" type="text" style="width: 61%;" class="form-control" name="captcha" placeholder="{{ \Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider::trans('login_captcha.captcha') }}" required>'
    captchaTpl += '<span class="captcha-img" style="width: 37%;height: 33.5px;position: absolute;top: 0;right: 0;border-radius: .25rem;border: 1px solid #dbe3e6;">'
    captchaTpl += '<img id="verify" src="{{ $captchaUrl }}" data-src="{{ $captchaUrl }}" alt="{{ \Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider::trans('login_captcha.captcha') }}" title="{{ \Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider::trans('login_captcha.refresh_captcha') }}" class="captcha" style="cursor: pointer;width: 100%;height: 100%;border-radius: .25rem;">'
    captchaTpl += '</span>'
    captchaTpl += '<div class="form-control-position">'
    captchaTpl += '<i class="feather icon-image"></i>'
    captchaTpl += '</div>'
    captchaTpl += '<label for="captcha">{{ \Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider::trans('login_captcha.captcha') }}</label>'
    captchaTpl += '<div class="help-block with-errors"></div>'
    captchaTpl += '</fieldset>';

    $(captchaTpl).insertAfter($("#login-form fieldset.form-label-group").get(1));

    $("#verify").click(function () {
        var verifyImg = $(this).data("src");
        $(this).attr("src", verifyImg.replace(/\?.*$/, "") + "?" + Math.random());
    });

    $(".dcat-login-captcha .with-errors").bind("DOMNodeInserted", function () {
        if ($("#captcha").val() !== "" && $(this).html().length > 0) {
            $("#verify").trigger("click");
        }
    });
})();
