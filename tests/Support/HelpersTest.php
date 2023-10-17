<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\DcatLoginCaptcha\Tests\Support;

it('can check login captcha', function (): void {
    expect(login_captcha_check('foo'))->toBeBool();
})->group(__DIR__, __FILE__);

it('can get login captcha url', function (): void {
    expect(login_captcha_url())->toBeString();
})->group(__DIR__, __FILE__);

it('can get login captcha content', function (): void {
    expect(login_captcha_content())->toBeString();
})->group(__DIR__, __FILE__);
