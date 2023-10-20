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

    /**
     * @noinspection AnonymousFunctionStaticInspection
     */
    public function form(): void
    {
        $this->switch('enabled', $this->trans('login-captcha.enabled'))
            ->customFormat(function (bool $value): int {
                return (int) $value;
            })
            ->saving(function (int $value): bool {
                return (bool) $value;
            })
            ->rules('required|boolean');

        $this->text('length', $this->trans('login-captcha.length'))
            ->required()
            ->rules('required|integer|between:3,6');

        $this->textarea('charset', $this->trans('login-captcha.charset'))
            ->rows(3)
            ->required()
            ->rules('required|string');

        $this->text('width', $this->trans('login-captcha.width'))
            ->required()
            ->rules('required|integer|between:100,200');

        $this->text('height', $this->trans('login-captcha.height'))
            ->required()
            ->rules('required|integer|between:30,80');

        $this->radio('type', $this->trans('login-captcha.type'))
            ->options([
                'png' => 'png',
                'jpeg' => 'jpeg',
                'gif' => 'gif',
            ])
            ->required()
            ->rules('required|string');

        $this->text('font', $this->trans('login-captcha.font'))
            ->rules('nullable|file');

        // $this->hidden('fingerprint', $this->trans('login-captcha.fingerprint'));
        // $this->hidden('captcha_phrase_session_key', $this->trans('login-captcha.captcha_phrase_session_key'));
    }

    protected function formatInput(array $input): array
    {
        $input['font'] = $input['font'] ?? null ?: null;

        return $input;
    }
}
