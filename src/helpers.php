<?php

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use Gregwar\Captcha\PhraseBuilder;
use Guanguans\DcatLoginCaptcha\DcatLoginCaptchaServiceProvider;
use Illuminate\Support\Facades\Session;

if (! function_exists('dcat_login_captcha_check')) {
    /**
     * 登录验证码检查.
     */
    function dcat_login_captcha_check(string $value): bool
    {
        if (is_null(Session::get(DcatLoginCaptchaServiceProvider::setting('phrase_session_key') ?? 'login_captcha_phrase'))) {
            return false;
        }

        if (! PhraseBuilder::comparePhrases(Session::get(DcatLoginCaptchaServiceProvider::setting('phrase_session_key') ?? 'login_captcha_phrase'), $value)) {
            return false;
        }

        Session::forget(DcatLoginCaptchaServiceProvider::setting('phrase_session_key') ?? 'login_captcha_phrase');

        return true;
    }
}
