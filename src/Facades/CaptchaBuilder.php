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
 * @method static build($width = 150, $height = 40, $font = null, $fingerprint = null)
 * @method static buildAgainstOCR($width = 150, $height = 40, $font = null, $fingerprint = null)
 * @method static create($phrase = null)
 * @method static distort($image, $width, $height, $bg)
 * @method static get($quality = 90)
 * @method static getContents()
 * @method static getFingerprint()
 * @method static getGd()
 * @method static getPhrase()
 * @method static inline($quality = 90)
 * @method static isOCRReadable()
 * @method static output($quality = 90)
 * @method static save($filename, $quality = 90)
 * @method static setBackgroundColor($r, $g, $b)
 * @method static setBackgroundImages(array $backgroundImages)
 * @method static setDistortion($distortion)
 * @method static setIgnoreAllEffects($ignoreAllEffects)
 * @method static setInterpolation($interpolate = true)
 * @method static setLineColor($r, $g, $b)
 * @method static setMaxAngle($maxAngle)
 * @method static setMaxBehindLines($maxBehindLines)
 * @method static setMaxFrontLines($maxFrontLines)
 * @method static setMaxOffset($maxOffset)
 * @method static setPhrase($phrase)
 * @method static setTextColor($r, $g, $b)
 * @method static testPhrase($phrase)
 *
 * @see \Gregwar\Captcha\CaptchaBuilder
 */
class CaptchaBuilder extends Facade
{
    /**
     * {@inheritdoc}
     */
    public static function getFacadeAccessor()
    {
        return 'gregwar.captcha-builder';
    }
}
