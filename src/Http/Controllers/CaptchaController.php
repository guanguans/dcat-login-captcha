<?php

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\DcatLoginCaptcha\Http\Controllers;

use Guanguans\DcatLoginCaptcha\Facades\CaptchaBuilder;
use Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
    public function generate()
    {
        ob_get_contents() && ob_clean();

        Session::put(LoginCaptchaServiceProvider::setting('phrase_session_key'), CaptchaBuilder::getPhrase());

        return \response(CaptchaBuilder::get())->header('Content-Type', 'image/png');
    }
}
