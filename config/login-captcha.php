<?php

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

return [
    'length' => 4,
    'charset' => 'abcdefghijklmnpqrstuvwxyz23456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',
    'width' => 150,
    'height' => 43,
    'type' => 'png', // ['png', 'jpeg', 'gif']
    'font' => null,
    'fingerprint' => null,
    'captcha_phrase_session_key' => 'login_captcha_phrase',
];
