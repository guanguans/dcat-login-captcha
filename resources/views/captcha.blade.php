(function () {
    var captchaTpl;
    captchaTpl = '<fieldset class="form-label-group form-group position-relative has-icon-left lake-login-captcha">'
    captchaTpl += '<input id="captcha" type="text" style="width: 61%;" class="form-control" name="captcha" placeholder="验证码" required>'
    captchaTpl += '<span class="captcha-img" style="width: 37%;height: 34px;position: absolute;top: 0;right: 0;border-radius: .25rem;border: 1px solid #dbe3e6;">'
    captchaTpl += '<img id="verify" src="{{ $captchaUrl }}" data-src="{{ $captchaUrl }}" alt="验证码" title="刷新验证码" class="captcha" style="cursor: pointer;width: 100%;border-radius: .25rem;">'
    captchaTpl += '</span>'
    captchaTpl += '<div class="form-control-position">'
    captchaTpl += '<i class="feather icon-image"></i>'
    captchaTpl += '</div>'
    captchaTpl += '<label for="captcha">验证码</label>'
    captchaTpl += '<div class="help-block with-errors"></div>'
    captchaTpl += '</fieldset>';

    $(captchaTpl).insertAfter($("#login-form fieldset.form-label-group").get(1));

    $("#verify").click(function () {
        var verifyImg = $(this).data("src");
        $(this).attr("src", verifyImg.replace(/\?.*$/, "") + "?" + Math.random());
    });

    $(".lake-login-captcha .with-errors").bind("DOMNodeInserted", function () {
        if ($("#captcha").val() !== "" && $(this).html().length > 0) {
            $("#verify").trigger("click");
        }
    });
})();
