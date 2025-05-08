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
