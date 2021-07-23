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

class BootingAdmin
{
    use HasFormResponse;

    public function __invoke()
    {
        if (Helper::matchRequestPath('GET:admin/auth/login')) {
            Admin::script($this->buildCaptchaScript());
        }

        if (Helper::matchRequestPath('POST:admin/auth/login')) {
            $validator = Validator::make(Request::post(), ['captcha' => 'required|dcat_login_captcha']);

            $validator->fails() and $this->throwHttpResponseException($validator);
        }
    }

    /**
     * Build captcha script.
     */
    protected function buildCaptchaScript()
    {
        return (string) view('guanguans.dcat-login-captcha::captcha', [
            'captchaUrl' => \login_captcha_url(),
        ]);
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
