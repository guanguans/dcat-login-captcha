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

use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Request;

class SetResponseContentType
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, \Closure $next, string $type): Response
    {
        return tap($next($request), function (Response $response) use ($type): void {
            $response->header('Content-Type', sprintf('image/%s', $type));
        });
    }
}
