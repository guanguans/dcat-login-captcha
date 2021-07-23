<?php

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\DcatLoginCaptcha\Http\Controllers;

use Gregwar\Captcha\CaptchaBuilder;
use Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;

class CaptchaController extends Controller
{
    public function generate()
    {
        if (ob_get_contents()) {
            ob_clean();
        }
        /* @var CaptchaBuilder $builder */
        $builder = app(CaptchaBuilder::class);

        Session::put(LoginCaptchaServiceProvider::setting('phrase_session_key'), $builder->getPhrase());

        return \response($builder->get())->header('Content-Type', 'image/png');
    }
}
