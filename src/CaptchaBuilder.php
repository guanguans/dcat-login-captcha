<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\DcatLoginCaptcha;

use Illuminate\Support\Traits\Macroable;
use Illuminate\Support\Traits\Tappable;

class CaptchaBuilder extends \Gregwar\Captcha\CaptchaBuilder
{
    // use Conditionable;
    use Macroable;
    use Tappable;
}
