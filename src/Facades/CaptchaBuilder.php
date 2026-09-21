<?php

/** @noinspection ParameterImplicitlyNullableInspection */
/** @noinspection PhpFullyQualifiedNameUsageInspection */
declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/dcat-login-captcha
 */

namespace Guanguans\DcatLoginCaptcha\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \Gregwar\Captcha\CaptchaBuilder create(string|null $phrase = null)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder build(int $width = 150, int $height = 40, string|null $font = null, int[] $fingerprint = null)
 * @method static void buildAgainstOCR(int $width = 150, int $height = 40, string|null $font = null, int[] $fingerprint = null)
 * @method static \GdImage|null distort(\GdImage $image, int $width, int $height, int $bg = 0)
 * @method static string get(int $quality = 90)
 * @method static int getBackgroundAlpha()
 * @method static \GdImage|null getContents()
 * @method static int[] getFingerprint()
 * @method static \GdImage|null getGd()
 * @method static string getImageType()
 * @method static string|null getPhrase()
 * @method static string inline(int $quality = 90)
 * @method static bool isOCRReadable()
 * @method static void output(int $quality = 90)
 * @method static void save(string|null $filename = null, int $quality = 90)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder setBackgroundAlpha(int $alpha)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder setBackgroundColor(int $r, int $g, int $b)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder setBackgroundImages(string[] $backgroundImages)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder setDistortion(int|bool $distortion)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder setIgnoreAllEffects(bool $ignoreAllEffects)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder setImageType(string|null $imageType = null)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder setInterpolation(bool $interpolate = true)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder setLineColor(int $r, int $g, int $b)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder setMaxAngle(int $maxAngle)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder setMaxBehindLines(int|null $maxBehindLines)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder setMaxFrontLines(int|null $maxFrontLines)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder setMaxOffset(int $maxOffset)
 * @method static void setPhrase(string|null $phrase = null)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder setScatterEffect(bool $scatterEffect)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder setTextColor(int $r, int $g, int $b)
 * @method static bool testPhrase(string $phrase)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder|mixed when(\Closure|mixed|null $value = null, callable|null $callback = null, callable|null $default = null)
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder|mixed unless(\Closure|mixed|null $value = null, callable|null $callback = null, callable|null $default = null)
 * @method static mixed withLocale(string $locale, \Closure $callback)
 * @method static void macro(string $name, object|callable $macro)
 * @method static void mixin(object $mixin, bool $replace = true)
 * @method static bool hasMacro(string $name)
 * @method static void flushMacros()
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder|\Illuminate\Support\HigherOrderTapProxy tap(callable|null $callback = null)
 *
 * @see \Guanguans\DcatLoginCaptcha\CaptchaBuilder
 */
class CaptchaBuilder extends Facade
{
    /**
     * @noinspection PhpMissingParentCallCommonInspection
     */
    protected static function getFacadeAccessor(): string
    {
        return \Guanguans\DcatLoginCaptcha\CaptchaBuilder::class;
    }
}
