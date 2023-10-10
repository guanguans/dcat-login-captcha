<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\DcatLoginCaptcha;

class Setting extends \Dcat\Admin\Extend\Setting
{
    public function title(): string
    {
        return $this->trans('login-captcha.setting');
    }

    public function form(): void
    {
        $this->text('length', LoginCaptchaServiceProvider::trans('login-captcha.length'))
            ->required()
            ->rules('required|integer|between:3,6');

        $this->textarea('charset', LoginCaptchaServiceProvider::trans('login-captcha.charset'))
            ->rows(3)
            ->required()
            ->rules('required|string');

        $this->text('width', LoginCaptchaServiceProvider::trans('login-captcha.width'))
            ->required()
            ->rules('required|integer|between:100,200');

        $this->text('height', LoginCaptchaServiceProvider::trans('login-captcha.height'))
            ->required()
            ->rules('required|integer|between:30,80');

        $this->radio('type', LoginCaptchaServiceProvider::trans('login-captcha.type'))
            ->options([
                'png' => 'png',
                'jpeg' => 'jpeg',
                'gif' => 'gif',
            ])
            ->required()
            ->rules('required|string');

        $this->text('font', LoginCaptchaServiceProvider::trans('login-captcha.font'))
            ->rules('nullable|file');

        $this->hidden('fingerprint', LoginCaptchaServiceProvider::trans('login-captcha.fingerprint'));
        $this->hidden('captcha_phrase_session_key', LoginCaptchaServiceProvider::trans('login-captcha.captcha_phrase_session_key'));
    }

    protected function formatInput(array $input): array
    {
        $input['font'] = $input['font'] ?? null ?: null;

        return $input;
    }
}
