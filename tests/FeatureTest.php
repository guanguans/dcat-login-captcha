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

it('can generate login captcha', function (): void {
    $this->get('admin/captcha/generate')
        ->assertOk()
        ->assertHeader('Content-Type', 'image/png');
})->group(__DIR__, __FILE__);
