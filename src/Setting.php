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

namespace Guanguans\DcatLoginCaptcha;

class Setting extends \Dcat\Admin\Extend\Setting
{
    /**
     * @noinspection PhpMissingParentCallCommonInspection
     */
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
            ->customFormat(fn (bool $value): int => (int) $value)
            ->saving(fn (int $value): bool => (bool) $value)
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

    /**
     * @noinspection MethodVisibilityInspection
     * @noinspection PhpMissingParentCallCommonInspection
     */
    protected function formatInput(array $input): array
    {
        $input['font'] = $input['font'] ?? null ?: null;

        return $input;
    }
}
