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

/**
 * @method static void build(void $length = null, void $charset = null)
 * @method static void niceize(void $str)
 * @method static void doNiceize(void $str)
 * @method static void comparePhrases(void $str1, void $str2)
 *
 * @see \Gregwar\Captcha\PhraseBuilder
 */
class PhraseBuilder extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'gregwar.phrase-builder';
    }
}
