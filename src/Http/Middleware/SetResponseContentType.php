<?php

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\DcatLoginCaptcha\Http\Middleware;

use Closure;
use Illuminate\Http\Response;

class SetResponseContentType
{
    /**
     * Handle an incoming request.
     *
     * @param $request
     *
     * @return \Illuminate\Http\Response
     */
    public function handle($request, Closure $next, string $type)
    {
        return tap($next($request), function (Response $response) use ($type) {
            $response->header('Content-Type', sprintf('image/%s', $type));
        });
    }
}
