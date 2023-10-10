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

beforeEach(function (): void {
    $this->setting = new Setting(new LoginCaptchaServiceProvider(app()));
});

it('can get title', function (): void {
    expect($this->setting)->title()->toBeString();
})->group(__DIR__, __FILE__);

it('can handle input', function (): void {
    expect($this->setting)->handle([])->toBeInstanceOf(JsonResponse::class);
})->group(__DIR__, __FILE__);

it('can build form', function (): void {
    expect($this->setting)->form()->toBeNull();
})->group(__DIR__, __FILE__);
