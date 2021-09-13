<?php

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\DcatLoginCaptcha;

use Dcat\Admin\Admin;
use Dcat\Admin\Support\Helper;
use Dcat\Admin\Traits\HasFormResponse;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class BootingHandler
{
    use HasFormResponse;

    public function __invoke()
    {
        if (Helper::matchRequestPath('GET:'.$authLoginBasePath = ltrim(admin_base_path('auth/login'), '/'))) {
            Admin::script($this->buildCaptchaScript());
        }

        if (Helper::matchRequestPath('POST:'.$authLoginBasePath)) {
            $validator = Validator::make(Request::post(), [
                'captcha' => 'required|dcat_login_captcha',
            ]);

            $validator->fails() and $this->throwHttpResponseException($validator);
        }
    }

    /**
     * Build captcha script.
     */
    protected function buildCaptchaScript()
    {
        [$captchaUrl, $langCaptcha, $langRefreshCaptcha] = [
            login_captcha_url(),
            LoginCaptchaServiceProvider::trans('login_captcha.captcha'),
            LoginCaptchaServiceProvider::trans('login_captcha.refresh_captcha'),
        ];

        return <<<js
(function () {
    captchaTpl = '<fieldset class="form-label-group form-group position-relative has-icon-left dcat-login-captcha">';
    captchaTpl += '<input id="captcha" type="text" style="width: 61%;" class="form-control" name="captcha" placeholder="$langCaptcha" required />';
    captchaTpl += '<span class="captcha-img" style="width: 37%;height: 33.5px;position: absolute;top: 0;right: 0;border-radius: .25rem;border: 1px solid #dbe3e6;">';
    captchaTpl += '<img id="verify" src="$captchaUrl" data-src="$captchaUrl" alt="$langCaptcha" title="$langRefreshCaptcha" class="captcha" style="cursor: pointer;width: 100%;height: 100%;border-radius: .25rem;">';
    captchaTpl += '</span>';
    captchaTpl += '<div class="form-control-position">';
    captchaTpl += '<i class="feather icon-image"></i>';
    captchaTpl += '</div>';
    captchaTpl += '<label for="captcha">$langCaptcha</label>';
    captchaTpl += '<div class="help-block with-errors"></div>';
    captchaTpl += '</fieldset>';

    $(captchaTpl).insertAfter($("#login-form fieldset.form-label-group").get(1));

    $("#verify").click(function () {
        verifyImg = $(this).data("src");
        $(this).attr("src", verifyImg.replace(/\?.*$/, "") + "?" + Math.random());
    });

    $(".dcat-login-captcha .with-errors").bind("DOMNodeInserted", function () {
        if ($("#captcha").val() !== "" && $(this).html().length > 0) {
            $("#verify").trigger("click");
        }
    });
})();
js;
    }

    /**
     * Throw HttpResponseException.
     *
     * @param array|MessageBag|\Illuminate\Validation\Validator $validationMessages
     */
    protected function throwHttpResponseException($validationMessages)
    {
        throw new HttpResponseException($this->validationErrorsResponse($validationMessages));
    }
}
