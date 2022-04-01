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

        return $input;
    }

    /**
     * 处理请求.
     *
     * @return \Dcat\Admin\Http\JsonResponse
     */
    public function handle(array $input)
    {
        return parent::handle($input);
    }

    /**
     * {@inheritdoc}
     */
    public function form()
    {
        $this->text('length', LoginCaptchaServiceProvider::trans('login_captcha.length'))
            ->required()
            ->rules('required|integer|min:3|max:6');

        $this->textarea('charset', LoginCaptchaServiceProvider::trans('login_captcha.charset'))
            ->rows(3)
            ->required()
            ->rules('required');

        $this->text('width', LoginCaptchaServiceProvider::trans('login_captcha.width'))
            ->required()
            ->rules('required|integer|min:100|max:200');

        $this->text('height', LoginCaptchaServiceProvider::trans('login_captcha.height'))
            ->required()
            ->rules('required|integer|min:30|max:80');

        $this->radio('type', LoginCaptchaServiceProvider::trans('login_captcha.type'))
            ->options([
                'png' => 'png',
                'jpeg' => 'jpeg',
                'gif' => 'gif',
            ])
            ->required()
            ->rules([
                'required',
            ]);

        $this->text('font', LoginCaptchaServiceProvider::trans('login_captcha.font'))
            ->rules('nullable|file');

        $this->hidden('fingerprint', LoginCaptchaServiceProvider::trans('login_captcha.fingerprint'));

        $this->hidden('captcha_phrase_session_key', LoginCaptchaServiceProvider::trans('login_captcha.captcha_phrase_session_key'));
    }
}
