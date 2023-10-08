<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\DcatLoginCaptcha\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class CaptchaController extends Controller
{
    public function __invoke(): Response
    {
        return response(login_captcha_content());
    }
}
