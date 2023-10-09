<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\DcatLoginCaptcha\Tests\Facades;

use Guanguans\DcatLoginCaptcha\Facades\PhraseBuilder;

it('can build captcha phrase', function (): void {
    expect(PhraseBuilder::build())->toBeString();
})->group(__DIR__, __FILE__);
