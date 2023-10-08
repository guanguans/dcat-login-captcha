<?php

declare(strict_types=1);

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
 * @method static void getContents()
 * @method static \Gregwar\Captcha\CaptchaBuilder setInterpolation(void $interpolate = true)
 * @method static void setPhrase(void $phrase)
 * @method static void setDistortion(void $distortion)
 * @method static void setMaxBehindLines(void $maxBehindLines)
 * @method static void setMaxFrontLines(void $maxFrontLines)
 * @method static void setMaxAngle(void $maxAngle)
 * @method static void setMaxOffset(void $maxOffset)
 * @method static void getPhrase()
 * @method static void testPhrase(void $phrase)
 * @method static void create(void $phrase = null)
 * @method static void setTextColor(void $r, void $g, void $b)
 * @method static void setBackgroundColor(void $r, void $g, void $b)
 * @method static void setLineColor(void $r, void $g, void $b)
 * @method static \Gregwar\Captcha\CaptchaBuilder setIgnoreAllEffects(bool $ignoreAllEffects)
 * @method static void setBackgroundImages(array $backgroundImages)
 * @method static void isOCRReadable()
 * @method static void buildAgainstOCR(void $width = 150, void $height = 40, void $font = null, void $fingerprint = null)
 * @method static void build(void $width = 150, void $height = 40, void $font = null, void $fingerprint = null)
 * @method static void distort(void $image, void $width, void $height, void $bg)
 * @method static void save(void $filename, void $quality = 90)
 * @method static void getGd()
 * @method static void get(void $quality = 90)
 * @method static void inline(void $quality = 90)
 * @method static void output(void $quality = 90)
 * @method static array getFingerprint()
 * @method static void macro(string $name, callable|object $macro)
 * @method static void mixin(object $mixin, bool $replace = true)
 * @method static bool hasMacro(string $name)
 * @method static void flushMacros()
 * @method static \Guanguans\DcatLoginCaptcha\CaptchaBuilder|\Illuminate\Support\HigherOrderTapProxy tap(null|callable $callback = null)
 *
 * @see \Guanguans\DcatLoginCaptcha\CaptchaBuilder
 */
class CaptchaBuilder extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Guanguans\DcatLoginCaptcha\CaptchaBuilder::class;
    }
}
