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

use Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

it('can generate and dont validate captcha', function (): void {
    $this
        ->get(admin_base_path('auth/login'))
        ->assertSee([
            'captcha-input',
            'captcha-img',
        ])
        ->assertOk();

    $this
        ->postJson(
            admin_base_path('auth/login'),
            [
                'username' => 'admin',
                'password' => 'admin',
                'captcha' => Str::random(4),
            ]
        )
        ->assertStatus(422);
})->group(__DIR__, __FILE__);

it('can generate and validate captcha', function (): void {
    $this
        ->get(admin_base_path(LoginCaptchaServiceProvider::setting('route.uri')))
        ->assertOk()
        ->assertHeader('Content-Type', \sprintf('image/%s', LoginCaptchaServiceProvider::setting('type')));

    $this
        ->postJson(
            admin_base_path('auth/login'),
            [
                'username' => 'admin',
                'password' => 'admin',
                'captcha' => Session::get(LoginCaptchaServiceProvider::setting('captcha_phrase_session_key')),
            ]
        )
        ->assertLocation('/');
})->group(__DIR__, __FILE__);
