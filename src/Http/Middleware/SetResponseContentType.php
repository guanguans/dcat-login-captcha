<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/dcat-login-captcha
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
