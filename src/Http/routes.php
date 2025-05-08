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

use Guanguans\DcatLoginCaptcha\Http\Controllers\CaptchaController;
use Guanguans\DcatLoginCaptcha\Http\Middleware\CleanObContents;
use Guanguans\DcatLoginCaptcha\Http\Middleware\SetResponseContentType;
use Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider;
use Illuminate\Support\Facades\Route;

Route::get(LoginCaptchaServiceProvider::setting('route.uri'), CaptchaController::class)
    ->name(LoginCaptchaServiceProvider::setting('route.name'))
    ->middleware([
        SetResponseContentType::class,
        CleanObContents::class,
    ]);
