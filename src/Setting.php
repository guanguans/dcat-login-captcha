<?php

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\DcatLoginCaptcha;

use Dcat\Admin\Extend\Setting as Form;

class Setting extends Form
{
    /**
     * {@inheritdoc}
     */
    public function title()
    {
        return $this->trans('login_captcha.setting');
    }

    /**
     * {@inheritdoc}
     */
    protected function formatInput(array $input)
    {
        $input['font'] = $input['font'] ?: null;
        $input['fingerprint'] = $input['fingerprint'] ?: null;

        return $input;
    }

    /**
     * {@inheritdoc}
     */
    public function form()
    {
        $this->text('length', LoginCaptchaServiceProvider::trans('login_captcha.length'))
            ->required()
            ->default(config('login_captcha.length'));

        $this->textarea('charset', LoginCaptchaServiceProvider::trans('login_captcha.charset'))
            ->required()
            ->default(config('login_captcha.charset'));

        $this->text('width', LoginCaptchaServiceProvider::trans('login_captcha.width'))
            ->required()
            ->default(config('login_captcha.width'));

        $this->text('height', LoginCaptchaServiceProvider::trans('login_captcha.height'))
            ->required()
            ->default(config('login_captcha.height'));

        $this->text('font', LoginCaptchaServiceProvider::trans('login_captcha.font'));

        $this->text('fingerprint', LoginCaptchaServiceProvider::trans('login_captcha.fingerprint'));

        $this->text('phrase_session_key', LoginCaptchaServiceProvider::trans('login_captcha.phrase_session_key'))
            ->required()
            ->default(config('login_captcha.phrase_session_key'));
    }
}
