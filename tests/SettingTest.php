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
