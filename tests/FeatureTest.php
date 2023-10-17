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

it('can generate login captcha', function (): void {
    $this->get(admin_base_path(LoginCaptchaServiceProvider::setting('route.uri')))
        ->assertOk()
        ->assertHeader('Content-Type', sprintf('image/%s', LoginCaptchaServiceProvider::setting('type')));
})->group(__DIR__, __FILE__);
