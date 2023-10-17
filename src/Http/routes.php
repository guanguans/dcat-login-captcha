<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
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
