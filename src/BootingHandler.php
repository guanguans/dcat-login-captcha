<?php

declare(strict_types=1);

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

    public function __invoke(): void
    {
        $loginPath = ltrim(admin_base_path('auth/login'), '/');
        if (Helper::matchRequestPath("GET:$loginPath")) {
            Admin::script($this->buildCaptchaScript());
        }

        if (Helper::matchRequestPath("POST:$loginPath")) {
            $validator = Validator::make(Request::post(), [
                'captcha' => 'required|dcat_login_captcha',
            ]);

            $validator->fails() and $this->throwHttpResponseException($validator);
        }
    }

    protected function buildCaptchaScript(): string
    {
        [$captchaUrl, $langCaptcha, $langRefreshCaptcha] = [
            login_captcha_url(),
            LoginCaptchaServiceProvider::trans('login-captcha.captcha'),
            LoginCaptchaServiceProvider::trans('login-captcha.refresh_captcha'),
        ];

        return /** @lang JavaScript */ <<<js
            (function () {
                captchaHtml = `
            <fieldset class="form-label-group form-group position-relative has-icon-left dcat-login-captcha">
                <input id="captcha" class="form-control" type="text" style="width: 61%;" name="captcha" placeholder="$langCaptcha" required>
                <span class="captcha-img" style="width: 37%;height: 33.5px;position: absolute;top: 0;right: 0;border-radius: .25rem;border: 1px solid #dbe3e6;">
                    <img id="verify" class="captcha" src="$captchaUrl" data-src="$captchaUrl" alt="$langCaptcha" title="$langRefreshCaptcha" style="cursor: pointer;width: 100%;height: 100%;border-radius: .25rem;">
                </span>
                <div class="form-control-position"><i class="feather icon-image"></i></div>
                <label for="captcha">$langCaptcha</label>
                <div class="help-block with-errors"></div>
            </fieldset>
            `;

                $(captchaHtml).insertAfter($("#login-form fieldset.form-label-group").get(1));

                $("#verify").click(function () {
                    $(this).attr("src", $(this).data("src").replace(/\\?.*$/, "") + "?" + Math.random());
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
     * @param array|\Illuminate\Validation\Validator|MessageBag $validationMessages
     */
    protected function throwHttpResponseException($validationMessages): void
    {
        throw new HttpResponseException($this->validationErrorsResponse($validationMessages));
    }
}
