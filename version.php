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
    '1.0.0' => [
        'Initial release.',
    ],
    '1.0.1' => [
        'Add default config file.',
        'Add annotation for facades.',
        'Optimize `login_captcha_check` function.',
        'Optimize captcha generate.',
        'Optimize get setting config.',
        'Rename `dcat_login_captcha_check`->`login_captcha_check`.',
        'Rename `dcat_login_captcha_url`->`login_captcha_url`.',
    ],
    '1.0.2' => [
        'Add login_captcha_get function.',
        'Update lang files.',
        'Update extension alias and description.',
        'Optimize LoginCaptchaServiceProvider.',
        'Optimize setting form.',
    ],
    '1.0.3' => [
        'Add CleanObContents Middleware.',
    ],
    '1.0.4' => [
        'Add SetResponseContentType Middleware.',
        'Add content type setting config.',
    ],
    '1.0.5' => [
        'Add BootingHandler.',
    ],
    '1.0.6' => [
        'Rename src/BootingAdmin.php -> src/BootingHandler.php.',
        'Remove src/Http/Controllers/CaptchaController.php`.',
    ],
    '1.0.7' => [
        'Optimize `buildCaptchaJsScript`.',
    ],
    '1.0.8' => [
        'Fix cant match routing path(#8).',
    ],
    '1.0.9' => [
        'Add parameters to the `SetResponseContentType` middleware.',
        'Update github config files.',
        'Update phpunit/phpunit requirement from ^7.0 || ^8.0 to ^7.0 || ^8.0 || ^9.0.',
        'Optimize booting `BootingHandler`.',
        'Optimize setting form .',
    ],
    '1.0.10' => [
        'Compatible callback type.',
    ],
    '1.0.11' => [
        'Rename `phrase_session_key` -> `captcha_phrase_session_key`.',
        'Generate captcha random url.',
        'Replace `Closure routing` -> `CaptchaController`.',
        'Bump actions/cache from 2 to 3.',
        'Bump actions/checkout from 2 to 3.',
        'Update overtrue/phplint requirement from ^2.3 || ^3.0 to ^2.3 || ^3.0 || ^4.0.',
    ],
    '1.0.12' => [
        'Bump codecov/codecov-action from 2.1.0 to 3.',
        'Update author info.',
    ],
    '1.0.13' => [
        'Update JS.',
    ],
    '1.0.14' => [
        'Rename login_captcha_get -> login_captcha_content.',
        'Update github config files.',
    ],
    '1.0.15' => [
        'Fix captcha check.',
    ],
    '1.0.16' => [
        'Add migration files.',
    ],
    '1.0.17' => [
        'Fix migration file name.',
    ],
    '1.0.18' => [
        'Update to single action controller.',
        'Fix setting.',
        'Optimize migration file.',
    ],
    '1.0.19' => [
        'Fix loading config.',
        'Remove version update migration.',
        'Cancel service late registration.',
    ],
    '1.1.0' => [
        'chore(deps): update overtrue/phplint to support more versions.',
        'update LoginCaptchaServiceProvider.php to merge config correctly(#27).',
        'Bump dependabot/fetch-metadata from 1.3.5 to 1.3.6.',
        'Bump actions/stale from 6 to 7.',
        'Update vimeo/psalm requirement from ^4.0 to ^4.0 || ^5.0.',
        'Bump dependabot/fetch-metadata from 1.3.4 to 1.3.5.',
        'Bump dependabot/fetch-metadata from 1.3.3 to 1.3.4.',
        'Bump actions/stale from 5 to 6.',
    ],
    '2.0.0-RC1' => [
        'BootingHandler.php: add missing comment',
        'readme: Update requirements and installation steps',
        'vendor-bin: Add facade-documenter to composer.json',
        'CaptchaBuilder: add CaptchaBuilder class',
        'monorepo-builder-worker: Add guanguans/monorepo-builder-worker package',
        'rector: Add RemoveInterfacesRector',
        'rector: Add Rector configuration',
        'admin: Handle Dcat login captcha upgrade error',
        'controller: add return type declaration',
        'tests.yml: Update PHP versions',
        'xml: Fix InvalidReturnType and InvalidReturnStatement',
        'captcha: Remove captcha.blade.php',
        'lang: rename login_captcha.php to login-captcha.php',
        'tests: Refactor TestCase',
        'Merge pull request [#36](https://github.com/guanguans/monorepo-builder-worker/issues/36) from guanguans/dependabot/github_actions/stefanzweifel/git-auto-commit-action-5',
        'Merge pull request [#34](https://github.com/guanguans/monorepo-builder-worker/issues/34) from guanguans/dependabot/github_actions/codecov/codecov-action-4',
        'Merge pull request [#33](https://github.com/guanguans/monorepo-builder-worker/issues/33) from guanguans/dependabot/github_actions/actions/checkout-4',
        'Merge pull request [#32](https://github.com/guanguans/monorepo-builder-worker/issues/32) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.6.0',
        'Merge pull request [#31](https://github.com/guanguans/monorepo-builder-worker/issues/31) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.5.1',
        'Merge pull request [#30](https://github.com/guanguans/monorepo-builder-worker/issues/30) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.5.0',
        'Merge pull request [#29](https://github.com/guanguans/monorepo-builder-worker/issues/29) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.4.0',
        'Merge pull request [#28](https://github.com/guanguans/monorepo-builder-worker/issues/28) from guanguans/dependabot/github_actions/actions/stale-8',
    ],
    '2.0.0-RC2' => [
        'src: Add initConfig method',
        'tests: Install and enable login captcha extension',
        'tests: Update test database',
        'setting: remove unused handle method',
        'tests: Refactor defineDatabaseMigrations method',
        'FeatureTest: can generate login captcha',
        'Support: can check login captcha',
        'TestCase: Fix database migrations',
    ],
    '2.0.0' => [
        'readme: Update package links',
        'src: Update login captcha documentation',
        'views: Add captcha.blade.php view file',
        'serviceprovider: Fix LoginCaptchaServiceProvider validation',
        'src: Update LoginCaptchaServiceProvider.php',
        'LoginCaptchaServiceProvider: improve setupConfig method',
        'src: optimize LoginCaptchaServiceProvider',
    ],
    '2.0.1' => [
        'middleware: Update SetResponseContentType middleware',
        'captcha: refactor captcha blade template',
        'FeatureTest: update login captcha test',
    ],
    '2.1.0' => [
        'config: Support for multi apps control enabled login captcha',
        'readme: Update Composer installation instructions',
    ],
    '2.1.1' => [
        'config: Remove unused path in StaticClosureRector class',
        'LoginCaptchaServiceProvider: use self instead of static',
        'setting: Add `enabled` switch to form',
        'setting: Use this->trans() function to translate messages',
    ],
    '2.1.2' => [
        'refactor(coding-style): remove unused Rectors',
        'refactor(monorepo-builder): update release workers',
        'docs: Update installation instructions',
        'docs(README-zh_CN): Update Composer installation instructions',
        'chore(composer): update guanguans/ai-commit and guanguans/monorepo-builder-worker',
        'Merge pull request #41 from guanguans/dependabot/github_actions/actions/stale-9',
        'chore(deps): bump actions/stale from 8 to 9',
        'refactor(setting): update Setting.php',
    ],
    '2.2.0' => [
        'chore(deps): update laravel and testbench versions',
        'chore(workflows): update PHP version to 8.3',
        'chore(composer): Update composer-git-hooks version and rector package',
        'chore(composer): Add composer-updater script and options',
        'Merge pull request #45 from guanguans/dependabot/github_actions/codecov/codecov-action-4',
        'Merge pull request #46 from guanguans/dependabot/composer/rector/rector-tw-0.18or-tw-0.19or-tw-1.0',
        'chore(deps-dev): update rector/rector requirement from ^0.18 || ^0.19 to ^0.18 || ^0.19 || ^1.0',
        'chore(deps): bump codecov/codecov-action from 3 to 4',
        'Merge pull request #44 from guanguans/dependabot/github_actions/actions/cache-4',
        'chore(deps): bump actions/cache from 3 to 4',
        'Merge pull request #43 from guanguans/dependabot/composer/rector/rector-tw-0.18or-tw-0.19',
        'chore(deps-dev): update rector/rector requirement || ^0.19',
        'chore(composer): update facade-update command',
    ],
    '2.2.1' => [
        'ci(rector): add StaticClosureRector to rules',
        'chore(dependencies): update composer dependencies versions',
        'style(captcha): Improve code formatting and readability',
        'Merge pull request #53 from evenZh/issue-52-DOMNodeInserted_新版本的chrome_edge_已经不支持了',
        'DOMNodeInserted removed',
        'Merge pull request #51 from guanguans/dependabot/github_actions/dependabot/fetch-metadata-2.2.0',
        'chore(deps): bump dependabot/fetch-metadata from 2.1.0 to 2.2.0',
        'Merge pull request #49 from guanguans/dependabot/github_actions/dependabot/fetch-metadata-2.1.0',
        'chore(deps): bump dependabot/fetch-metadata from 2.0.0 to 2.1.0',
        'Merge pull request #47 from guanguans/dependabot/github_actions/dependabot/fetch-metadata-2.0.0',
        'chore(deps): bump dependabot/fetch-metadata from 1.6.0 to 2.0.0',
        'chore(config): update repository_url in config.yml',
    ],
    '2.3.0' => [
        'docs: Update Composer installation command for captcha package',
        'ci(chglog): Update changelog config and template formatting',
        'build(config): Update .editorconfig and .gitattributes',
        'build: Update linting config and composer dependencies',
        'Merge pull request #56 from guanguans/dependabot/github_actions/dependabot/fetch-metadata-2.3.0',
        'chore(deps): bump dependabot/fetch-metadata from 2.2.0 to 2.3.0',
        'Merge pull request #55 from guanguans/dependabot/github_actions/codecov/codecov-action-5',
        'chore(deps): bump codecov/codecov-action from 3 to 5',
    ],
    '2.4.0' => [
        'ci(workflows): Update Markdown linting and PHP tests configuration',
        'feat(workflows): Update PHP version in CI configuration',
    ],
    '3.0.0' => [
        'refactor(exceptions): implement ThrowableContract and reorganize exception handling',
        'test(helpers): add test for getting classes and reorder test cases',
        'refactor(rector-config): enhance Rector configuration and namespace declarations',
        'ci(github): remove issue templates and psalm workflow',
        'build(composer): enhance configuration and add script aliases',
        'ci(core): Remove obsolete files from the project',
        'refactor: apply rector',
        'style: apply php-cs-fixer',
        'feat(workflows): Upgrade PHP version to 8.0 across workflows',
        'style: apply php-cs-fixer',
    ],
    '3.0.1' => [
        'fix(captcha): update helper reference and enhance test coverage',
        'fix(scripts): adjust composer.json and improve singleton registration',
        'refactor(middleware): enhance type declarations and formatting',
        'refactor(login-captcha): adjust visibility and organize methods',
        'feat(captcha): add additional trait support for CaptchaBuilder and PhraseBuilder',
        'ci(phpstan): clean up ignored errors and add .gitkeep file',
    ],
    '3.0.2' => [
        'ci(composer): enhance version script with additional tagging logic',
        'ci(versioning): add script to generate version changelogs',
    ],
];
