<?php

/** @noinspection PhpUnusedAliasInspection */
declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/dcat-login-captcha
 */

use Guanguans\PhpCsFixerCustomFixers\Fixer\CommandLineTool\BladeFormatterFixer;
use Guanguans\PhpCsFixerCustomFixers\Set\SetList;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return ECSConfig::configure()
    ->withSkip([
        BladeFormatterFixer::class => [
            __DIR__.'/resources/views/captcha.blade.php',
        ],
    ])
    ->withSets([SetList::COMMAND_LINE_TOOL]);
