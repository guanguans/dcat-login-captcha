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

namespace Guanguans\DcatLoginCaptcha\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static void build(void $length = null, void $charset = null)
 * @method static void niceize(void $str)
 * @method static void doNiceize(void $str)
 * @method static void comparePhrases(void $str1, void $str2)
 * @method static \Guanguans\DcatLoginCaptcha\PhraseBuilder|mixed when(\Closure|mixed|null $value = null, callable|null $callback = null, callable|null $default = null)
 * @method static \Guanguans\DcatLoginCaptcha\PhraseBuilder|mixed unless(\Closure|mixed|null $value = null, callable|null $callback = null, callable|null $default = null)
 * @method static mixed withLocale(string $locale, \Closure $callback)
 * @method static void macro(string $name, object|callable $macro)
 * @method static void mixin(object $mixin, bool $replace = true)
 * @method static bool hasMacro(string $name)
 * @method static void flushMacros()
 * @method static \Guanguans\DcatLoginCaptcha\PhraseBuilder|\Illuminate\Support\HigherOrderTapProxy tap(callable|null $callback = null)
 *
 * @see \Guanguans\DcatLoginCaptcha\PhraseBuilder
 */
class PhraseBuilder extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Guanguans\DcatLoginCaptcha\PhraseBuilder::class;
    }
}
