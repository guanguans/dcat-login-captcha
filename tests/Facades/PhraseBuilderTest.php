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

namespace Guanguans\DcatLoginCaptcha\Tests\Facades;

use Guanguans\DcatLoginCaptcha\Facades\PhraseBuilder;

it('can build captcha phrase', function (): void {
    expect(PhraseBuilder::build())->toBeString();
})->group(__DIR__, __FILE__);
