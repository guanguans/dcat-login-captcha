<?php

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use Guanguans\DcatLoginCaptcha\Http\Controllers\CaptchaController;
use Illuminate\Support\Facades\Route;

Route::get('captcha/generate', sprintf('%s@generate', CaptchaController::class))->name('captcha.generate');
