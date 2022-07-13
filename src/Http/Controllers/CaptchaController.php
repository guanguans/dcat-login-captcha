<?php

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\DcatLoginCaptcha\Http\Controllers;

use Illuminate\Routing\Controller;

class CaptchaController extends Controller
{
    public function generate()
    {
        return response(login_captcha_content());
    }
}
