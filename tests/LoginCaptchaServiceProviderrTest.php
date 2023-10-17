<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\DcatLoginCaptcha\Tests;

use Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider;
use Guanguans\DcatLoginCaptcha\Setting;
use Illuminate\Support\Facades\Validator;

it('can get provides', function (): void {
    expect(new LoginCaptchaServiceProvider(app()))
        ->provides()->toBeArray();
})->group(__DIR__, __FILE__);

it('can get setting form', function (): void {
    expect(new LoginCaptchaServiceProvider(app()))
        ->settingForm()->toBeInstanceOf(Setting::class);
})->group(__DIR__, __FILE__);

it('can check `dcat_login_captcha` rule', function (): void {
    expect(Validator::make(['captcha' => 'foo'], ['captcha' => 'dcat_login_captcha']))
        ->fails()->toBeTrue();
})->group(__DIR__, __FILE__);
