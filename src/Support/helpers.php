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

use Guanguans\DcatLoginCaptcha\Facades\CaptchaBuilder;
use Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

if (!\function_exists('login_captcha_check')) {
    /**
     * 登录验证码检查.
     */
    function login_captcha_check(string $value): bool
    {
        return Guanguans\DcatLoginCaptcha\PhraseBuilder::comparePhrases(
            Session::pull(LoginCaptchaServiceProvider::setting('captcha_phrase_session_key')),
            $value
        );
    }
}

if (!\function_exists('login_captcha_url')) {
    /**
     * 获取登录验证码 url 地址.
     */
    function login_captcha_url(?string $routeName = null): string
    {
        return admin_route(
            $routeName ?? LoginCaptchaServiceProvider::setting('route.name'),
            ['random' => Str::random()]
        );
    }
}

if (!\function_exists('login_captcha_content')) {
    /**
     * 获取登录验证码图像内容.
     *
     * @noinspection PhpVoidFunctionResultUsedInspection
     *
     * @psalm-suppress InvalidNullableReturnType
     * @psalm-suppress NullableReturnStatement
     * @psalm-suppress InvalidArgument
     */
    function login_captcha_content(int $quality = 90): string
    {
        Session::put(LoginCaptchaServiceProvider::setting('captcha_phrase_session_key'), CaptchaBuilder::getPhrase());

        return CaptchaBuilder::get($quality);
    }
}
