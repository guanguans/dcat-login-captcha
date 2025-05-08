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

return [
    'enabled' => true,

    'length' => 4,
    'charset' => 'abcdefghijklmnpqrstuvwxyz23456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',

    'width' => 150,
    'height' => 43,
    'font' => null,
    'fingerprint' => null,

    'type' => 'png', // ['png', 'jpeg', 'gif']
    'captcha_phrase_session_key' => 'login_captcha_phrase',

    'route' => [
        'uri' => 'captcha/generate',
        'name' => 'captcha.generate',
    ],
];
