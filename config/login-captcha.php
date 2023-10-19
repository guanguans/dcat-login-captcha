<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
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
