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
 * @method static build($length = null, $charset = null)
 * @method static comparePhrases($str1, $str2)
 * @method static doNiceize($str)
 * @method static niceize($str)
 *
 * @see \Gregwar\Captcha\PhraseBuilder
 */
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
