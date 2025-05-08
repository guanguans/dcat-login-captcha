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

it('can generate login captcha', function (): void {
    $this->get(admin_base_path(LoginCaptchaServiceProvider::setting('route.uri')))
        ->assertOk()
        ->assertHeader('Content-Type', sprintf('image/%s', LoginCaptchaServiceProvider::setting('type')));
})->group(__DIR__, __FILE__);
