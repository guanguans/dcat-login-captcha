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

namespace Guanguans\DcatLoginCaptcha\Support;

use Composer\Autoload\ClassLoader;
use Guanguans\DcatLoginCaptcha\Facades\CaptchaBuilder;
use Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider;
use Guanguans\DcatLoginCaptcha\PhraseBuilder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

if (!\function_exists('Guanguans\DcatLoginCaptcha\Support\classes')) {
    /**
     * @see https://github.com/alekitto/class-finder
     * @see https://github.com/ergebnis/classy
     * @see https://gitlab.com/hpierce1102/ClassFinder
     * @see https://packagist.org/packages/haydenpierce/class-finder
     * @see \get_declared_classes()
     * @see \get_declared_interfaces()
     * @see \get_declared_traits()
     * @see \DG\BypassFinals::enable()
     *
     * @noinspection RedundantDocCommentTagInspection
     *
     * @param callable(string, class-string): bool $filter
     */
    function classes(callable $filter): Collection
    {
        static $allClasses;

        $allClasses ??= collect(spl_autoload_functions())->flatMap(
            static fn (mixed $loader): array => \is_array($loader) && $loader[0] instanceof ClassLoader
                ? $loader[0]->getClassMap()
                : []
        );

        return $allClasses
            ->filter($filter)
            ->mapWithKeys(static function (string $file, string $class): array {
                try {
                    return [$class => new \ReflectionClass($class)];
                } catch (\Throwable $throwable) {
                    return [$class => $throwable];
                }
            });
    }
}

if (!\function_exists('Guanguans\DcatLoginCaptcha\Support\login_captcha_check')) {
    /**
     * 登录验证码检查.
     */
    function login_captcha_check(string $value): bool
    {
        return PhraseBuilder::comparePhrases(
            Session::pull(LoginCaptchaServiceProvider::setting('captcha_phrase_session_key')),
            $value
        );
    }
}

if (!\function_exists('Guanguans\DcatLoginCaptcha\Support\login_captcha_content')) {
    /**
     * 获取登录验证码图像内容.
     */
    function login_captcha_content(int $quality = 90): string
    {
        Session::put(LoginCaptchaServiceProvider::setting('captcha_phrase_session_key'), CaptchaBuilder::getPhrase());

        return CaptchaBuilder::get($quality);
    }
}

if (!\function_exists('Guanguans\DcatLoginCaptcha\Support\login_captcha_url')) {
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
