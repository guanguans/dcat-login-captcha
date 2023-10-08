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

use Dcat\Admin\Http\JsonResponse;

class Setting extends \Dcat\Admin\Extend\Setting
{
    public function title(): string
    {
        return $this->trans('login_captcha.setting');
    }

    public function handle(array $input): JsonResponse
    {
        return parent::handle($input);
    }

    public function form(): void
    {
        $this->text('length', LoginCaptchaServiceProvider::trans('login_captcha.length'))
            ->required()
            ->rules('required|integer|between:3,6');

        $this->textarea('charset', LoginCaptchaServiceProvider::trans('login_captcha.charset'))
            ->rows(3)
            ->required()
            ->rules('required|string');

        $this->text('width', LoginCaptchaServiceProvider::trans('login_captcha.width'))
            ->required()
            ->rules('required|integer|between:100,200');

        $this->text('height', LoginCaptchaServiceProvider::trans('login_captcha.height'))
            ->required()
            ->rules('required|integer|between:30,80');

        $this->radio('type', LoginCaptchaServiceProvider::trans('login_captcha.type'))
            ->options([
                'png' => 'png',
                'jpeg' => 'jpeg',
                'gif' => 'gif',
            ])
            ->required()
            ->rules('required|string');

        $this->text('font', LoginCaptchaServiceProvider::trans('login_captcha.font'))
            ->rules('nullable|file');

        $this->hidden('fingerprint', LoginCaptchaServiceProvider::trans('login_captcha.fingerprint'));
        $this->hidden('captcha_phrase_session_key', LoginCaptchaServiceProvider::trans('login_captcha.captcha_phrase_session_key'));
    }

    protected function formatInput(array $input): array
    {
        $input['font'] = $input['font'] ?: null;

        return $input;
    }
}
