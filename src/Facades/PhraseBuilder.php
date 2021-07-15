<?php

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\DcatLoginCaptcha\Facades;

use Illuminate\Support\Facades\Facade;

class PhraseBuilder extends Facade
{
    /**
     * {@inheritdoc}
     */
    public static function getFacadeAccessor()
    {
        return 'gregwar.phrase-builder';
    }
}
