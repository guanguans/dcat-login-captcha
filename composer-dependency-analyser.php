<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/dcat-login-captcha
 */

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

return (new Configuration)
    ->addPathsToScan([__DIR__.'/config/', __DIR__.'/resources/', __DIR__.'/updates/'], false)
    ->addPathsToExclude([
        __DIR__.'/src/Support/ComposerScripts.php',
        __DIR__.'/tests/',
        // __DIR__.'/workbench/',
    ])
    /** @see \ShipMonk\ComposerDependencyAnalyser\Analyser::CORE_EXTENSIONS */
    ->ignoreErrorsOnExtensions(
        [
            // 'ext-pdo',
        ],
        [ErrorType::SHADOW_DEPENDENCY]
    )
    ->ignoreErrorsOnPackages(
        [
            'symfony/http-foundation',
        ],
        [ErrorType::SHADOW_DEPENDENCY]
    );
