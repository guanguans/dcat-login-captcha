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
        $input['length'] = $input['length'] ?: 4;
        $input['charset'] = $input['charset'] ?: 'abcdefghijklmnpqrstuvwxyz23456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $input['width'] = $input['width'] ?: 150;
        $input['height'] = $input['height'] ?: 43;
        $input['font'] = $input['font'] ?: null;
        $input['fingerprint'] = $input['fingerprint'] ?: null;
        $input['phrase_session_key'] = $input['phrase_session_key'] ?: 'login_captcha_phrase';

        return $input;
    }

    /**
     * {@inheritdoc}
     */
    public function form()
    {
        $this->text('length', DcatLoginCaptchaServiceProvider::trans('login_captcha.length'))
            ->required()
            ->default(4);

        $this->textarea('charset', DcatLoginCaptchaServiceProvider::trans('login_captcha.charset'))
            ->required()
            ->default('abcdefghijklmnpqrstuvwxyz23456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');

        $this->text('width', DcatLoginCaptchaServiceProvider::trans('login_captcha.width'))
            ->required()
            ->default(150);

        $this->text('height', DcatLoginCaptchaServiceProvider::trans('login_captcha.height'))
            ->required()
            ->default(43);

        $this->text('font', DcatLoginCaptchaServiceProvider::trans('login_captcha.font'));

        $this->text('fingerprint', DcatLoginCaptchaServiceProvider::trans('login_captcha.fingerprint'));

        $this->text('phrase_session_key', DcatLoginCaptchaServiceProvider::trans('login_captcha.phrase_session_key'))
            ->required()
            ->default('login_captcha_phrase');
    }
}
