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

namespace Guanguans\DcatLoginCaptcha;

use Illuminate\Support\Traits\Macroable;
use Illuminate\Support\Traits\Tappable;

class PhraseBuilder extends \Gregwar\Captcha\PhraseBuilder
{
    // use Conditionable;
    use Macroable;
    use Tappable;
}
