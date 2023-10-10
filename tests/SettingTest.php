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

use Dcat\Admin\Http\JsonResponse;
use Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider;
use Guanguans\DcatLoginCaptcha\Setting;

it('is true', function (): void {
    $setting = new Setting(new LoginCaptchaServiceProvider(app()));
    expect($setting)
        ->handle(['font' => ''])
        ->toBeInstanceOf(JsonResponse::class);
})->group(__DIR__, __FILE__);
