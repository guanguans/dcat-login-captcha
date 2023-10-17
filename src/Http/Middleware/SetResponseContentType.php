<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\DcatLoginCaptcha\Http\Middleware;

use Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SetResponseContentType
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, \Closure $next): Response
    {
        return tap($next($request), static function (Response $response): void {
            $response->header('Content-Type', sprintf('image/%s', LoginCaptchaServiceProvider::setting('type')));
        });
    }
}
