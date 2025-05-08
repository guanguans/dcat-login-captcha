<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection SqlResolve */
/** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/dcat-login-captcha
 */

use Illuminate\Support\Collection;
use function Guanguans\DcatLoginCaptcha\Support\classes;
use function Guanguans\DcatLoginCaptcha\Support\login_captcha_check;
use function Guanguans\DcatLoginCaptcha\Support\login_captcha_content;
use function Guanguans\DcatLoginCaptcha\Support\login_captcha_url;

it('can get classes', function (): void {
    expect(
        classes(fn (string $file, string $class): bool => str($class)->startsWith('Rector'))
    )->toBeInstanceOf(Collection::class);
})->group(__DIR__, __FILE__);

it('can check login captcha', function (): void {
    expect(login_captcha_check('foo'))->toBeBool();
})->group(__DIR__, __FILE__);

it('can get login captcha content', function (): void {
    expect(login_captcha_content())->toBeString();
})->group(__DIR__, __FILE__);

it('can get login captcha url', function (): void {
    expect(login_captcha_url())->toBeString();
})->group(__DIR__, __FILE__);
