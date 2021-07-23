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
        ob_get_contents() && ob_clean();

        return \response(login_captcha_get())->header('Content-Type', 'image/png');
    }
}
