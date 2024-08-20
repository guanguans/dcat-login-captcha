<!--- BEGIN HEADER -->
# Changelog

All notable changes to this project will be documented in this file.
<!--- END HEADER -->

<a name="unreleased"></a>
## [Unreleased]


<a name="2.2.1"></a>
## [2.2.1] - 2024-08-20
### CI
- **rector:** add StaticClosureRector to rules

### Pull Requests
- Merge pull request [#53](https://github.com/guanguans/dcat-login-captcha/issues/53) from evenZh/issue-52-DOMNodeInserted_新版本的chrome_edge_已经不支持了
  - Merge pull request [#51](https://github.com/guanguans/dcat-login-captcha/issues/51) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-2.2.0
  - Merge pull request [#49](https://github.com/guanguans/dcat-login-captcha/issues/49) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-2.1.0
  - Merge pull request [#47](https://github.com/guanguans/dcat-login-captcha/issues/47) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-2.0.0
  
  
<a name="2.2.0"></a>
## [2.2.0] - 2024-03-21
### Pull Requests
- Merge pull request [#45](https://github.com/guanguans/dcat-login-captcha/issues/45) from guanguans/dependabot/github_actions/codecov/codecov-action-4
  - Merge pull request [#46](https://github.com/guanguans/dcat-login-captcha/issues/46) from guanguans/dependabot/composer/rector/rector-tw-0.18or-tw-0.19or-tw-1.0
  - Merge pull request [#44](https://github.com/guanguans/dcat-login-captcha/issues/44) from guanguans/dependabot/github_actions/actions/cache-4
  - Merge pull request [#43](https://github.com/guanguans/dcat-login-captcha/issues/43) from guanguans/dependabot/composer/rector/rector-tw-0.18or-tw-0.19
  
  
<a name="2.1.2"></a>
## [2.1.2] - 2024-01-08
### Docs
- Update installation instructions
- **README-zh_CN:** Update Composer installation instructions

### Refactor
- **coding-style:** remove unused Rectors
- **monorepo-builder:** update release workers
- **setting:** update Setting.php

### Pull Requests
- Merge pull request [#41](https://github.com/guanguans/dcat-login-captcha/issues/41) from guanguans/dependabot/github_actions/actions/stale-9
  
  
<a name="2.1.1"></a>
## [2.1.1] - 2023-10-19
### Feat
- **setting:** Add 'enabled' switch to form

### Refactor
- **LoginCaptchaServiceProvider:** use self instead of static
- **config:** Remove unused path in StaticClosureRector class
- **setting:** Use this->trans() function to translate messages


<a name="2.1.0"></a>
## [2.1.0] - 2023-10-19
### Docs
- **readme:** Update Composer installation instructions

### Feat
- **config:** Support for multi apps control enabled login captcha

### Refactor
- **version:** Update version.php


<a name="2.0.1"></a>
## [2.0.1] - 2023-10-17
### Fix
- **middleware:** Update SetResponseContentType middleware
- **phpstan-baseline:** Ignore casting error in LoginCaptchaServiceProvider
- **version:** Update version.php

### Refactor
- **captcha:** refactor captcha blade template

### Test
- **FeatureTest:** update login captcha test


<a name="2.0.0"></a>
## [2.0.0] - 2023-10-17
### Docs
- **readme:** Update package links
- **src:** Update login captcha documentation
- **src:** Update login captcha documentation

### Feat
- **views:** Add captcha.blade.php view file

### Fix
- **serviceprovider:** Fix LoginCaptchaServiceProvider validation
- **src:** Update LoginCaptchaServiceProvider.php

### Refactor
- **LoginCaptchaServiceProvider:** improve setupConfig method
- **src:** optimize LoginCaptchaServiceProvider


<a name="2.0.0-rc2"></a>
## [2.0.0-rc2] - 2023-10-13
### Feat
- **src:** Add initConfig method
- **tests:** Install and enable login captcha extension

### Fix
- **tests:** Update test database

### Refactor
- **setting:** remove unused handle method
- **tests:** Refactor defineDatabaseMigrations method

### Test
- **FeatureTest:** can generate login captcha
- **Support:** can check login captcha
- **TestCase:** Fix database migrations

### Pull Requests
- Merge pull request [#37](https://github.com/guanguans/dcat-login-captcha/issues/37) from guanguans/dependabot/github_actions/actions/checkout-4
  - Merge pull request [#38](https://github.com/guanguans/dcat-login-captcha/issues/38) from guanguans/dependabot/github_actions/stefanzweifel/git-auto-commit-action-5
  
  
<a name="2.0.0-rc1"></a>
## [2.0.0-rc1] - 2023-10-09
### Docs
- **BootingHandler.php:** add missing comment
- **readme:** Update requirements and installation steps
- **vendor-bin:** Add facade-documenter to composer.json

### Feat
- **CaptchaBuilder:** add CaptchaBuilder class
- **monorepo-builder-worker:** Add guanguans/monorepo-builder-worker package
- **rector:** Add RemoveInterfacesRector
- **rector:** Add Rector configuration
- **version:** Add 2.0.0-RC1 version

### Fix
- **admin:** Handle Dcat login captcha upgrade error
- **controller:** add return type declaration
- **tests.yml:** Update PHP versions
- **xml:** Fix InvalidReturnType and InvalidReturnStatement

### Refactor
- **captcha:** Remove captcha.blade.php
- **lang:** rename login_captcha.php to login-captcha.php
- **tests:** Refactor TestCase

### Pull Requests
- Merge pull request [#36](https://github.com/guanguans/dcat-login-captcha/issues/36) from guanguans/dependabot/github_actions/stefanzweifel/git-auto-commit-action-5
  - Merge pull request [#34](https://github.com/guanguans/dcat-login-captcha/issues/34) from guanguans/dependabot/github_actions/codecov/codecov-action-4
  - Merge pull request [#33](https://github.com/guanguans/dcat-login-captcha/issues/33) from guanguans/dependabot/github_actions/actions/checkout-4
  - Merge pull request [#32](https://github.com/guanguans/dcat-login-captcha/issues/32) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.6.0
  - Merge pull request [#31](https://github.com/guanguans/dcat-login-captcha/issues/31) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.5.1
  - Merge pull request [#30](https://github.com/guanguans/dcat-login-captcha/issues/30) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.5.0
  - Merge pull request [#29](https://github.com/guanguans/dcat-login-captcha/issues/29) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.4.0
  - Merge pull request [#28](https://github.com/guanguans/dcat-login-captcha/issues/28) from guanguans/dependabot/github_actions/actions/stale-8
  
  
<a name="v1.1.0"></a>
## [v1.1.0] - 2023-03-20
### Docs
- update CHANGELOG.md for version 1.1.0

### Fix
- **src:** update LoginCaptchaServiceProvider.php to merge config correctly([#27](https://github.com/guanguans/dcat-login-captcha/issues/27))

### Pull Requests
- Merge pull request [#26](https://github.com/guanguans/dcat-login-captcha/issues/26) from guanguans/dependabot/composer/overtrue/phplint-tw-2.3or-tw-3.0or-tw-4.0or-tw-9.0
  - Merge pull request [#25](https://github.com/guanguans/dcat-login-captcha/issues/25) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.3.6
  - Merge pull request [#24](https://github.com/guanguans/dcat-login-captcha/issues/24) from guanguans/dependabot/github_actions/actions/stale-7
  - Merge pull request [#23](https://github.com/guanguans/dcat-login-captcha/issues/23) from guanguans/dependabot/composer/vimeo/psalm-tw-4.0or-tw-5.0
  - Merge pull request [#22](https://github.com/guanguans/dcat-login-captcha/issues/22) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.3.5
  - Merge pull request [#21](https://github.com/guanguans/dcat-login-captcha/issues/21) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.3.4
  - Merge pull request [#20](https://github.com/guanguans/dcat-login-captcha/issues/20) from guanguans/dependabot/github_actions/actions/stale-6
  
  
<a name="v1.0.19"></a>
## [v1.0.19] - 2022-09-08

<a name="v1.0.18"></a>
## [v1.0.18] - 2022-09-01

<a name="v1.0.17"></a>
## [v1.0.17] - 2022-08-31

<a name="v1.0.16"></a>
## [v1.0.16] - 2022-08-31

<a name="v1.0.15"></a>
## [v1.0.15] - 2022-08-24
### Pull Requests
- Merge pull request [#17](https://github.com/guanguans/dcat-login-captcha/issues/17) from guanguans/dependabot/github_actions/dependabot/fetch-metadata-1.3.3
  
  
<a name="v1.0.14"></a>
## [v1.0.14] - 2022-07-13

<a name="v1.0.13"></a>
## [v1.0.13] - 2022-05-03

<a name="v1.0.12"></a>
## [v1.0.12] - 2022-04-06
### Pull Requests
- Merge pull request [#14](https://github.com/guanguans/dcat-login-captcha/issues/14) from guanguans/dependabot/github_actions/codecov/codecov-action-3
  
  
<a name="v1.0.11"></a>
## [v1.0.11] - 2022-04-01
### Pull Requests
- Merge pull request [#13](https://github.com/guanguans/dcat-login-captcha/issues/13) from guanguans/dependabot/github_actions/actions/cache-3
  - Merge pull request [#12](https://github.com/guanguans/dcat-login-captcha/issues/12) from guanguans/dependabot/github_actions/actions/checkout-3
  - Merge pull request [#11](https://github.com/guanguans/dcat-login-captcha/issues/11) from guanguans/dependabot/composer/overtrue/phplint-tw-2.3or-tw-3.0or-tw-4.0
  
  
<a name="v1.0.10"></a>
## [v1.0.10] - 2021-11-09

<a name="v1.0.9"></a>
## [v1.0.9] - 2021-10-17
### Pull Requests
- Merge pull request [#10](https://github.com/guanguans/dcat-login-captcha/issues/10) from guanguans/dependabot/github_actions/codecov/codecov-action-2.1.0
  - Merge pull request [#9](https://github.com/guanguans/dcat-login-captcha/issues/9) from guanguans/dependabot/composer/phpunit/phpunit-tw-7.0or-tw-8.0or-tw-9.0
  
  
<a name="v1.0.8"></a>
## [v1.0.8] - 2021-09-13

<a name="v1.0.7"></a>
## [v1.0.7] - 2021-07-31

<a name="v1.0.6"></a>
## [v1.0.6] - 2021-07-26

<a name="v1.0.5"></a>
## [v1.0.5] - 2021-07-23

<a name="v1.0.4"></a>
## [v1.0.4] - 2021-07-23
### Pull Requests
- Merge pull request [#7](https://github.com/guanguans/dcat-login-captcha/issues/7) from guanguans/imgbot
  
  
<a name="v1.0.3"></a>
## [v1.0.3] - 2021-07-23

<a name="v1.0.2"></a>
## [v1.0.2] - 2021-07-23

<a name="v1.0.1"></a>
## [v1.0.1] - 2021-07-23

<a name="v1.0.0"></a>
## v1.0.0 - 2021-07-23
### Pull Requests
- Merge pull request [#5](https://github.com/guanguans/dcat-login-captcha/issues/5) from guanguans/dependabot/composer/friendsofphp/php-cs-fixer-tw-2.17or-tw-3.0
  - Merge pull request [#4](https://github.com/guanguans/dcat-login-captcha/issues/4) from guanguans/imgbot
  - Merge pull request [#3](https://github.com/guanguans/dcat-login-captcha/issues/3) from guanguans/imgbot
  - Merge pull request [#1](https://github.com/guanguans/dcat-login-captcha/issues/1) from guanguans/dependabot/composer/vimeo/psalm-tw-3.11or-tw-4.0
  - Merge pull request [#2](https://github.com/guanguans/dcat-login-captcha/issues/2) from guanguans/dependabot/composer/overtrue/phplint-tw-2.3or-tw-3.0
  
  
[Unreleased]: https://github.com/guanguans/dcat-login-captcha/compare/2.2.1...HEAD
[2.2.1]: https://github.com/guanguans/dcat-login-captcha/compare/2.2.0...2.2.1
[2.2.0]: https://github.com/guanguans/dcat-login-captcha/compare/2.1.2...2.2.0
[2.1.2]: https://github.com/guanguans/dcat-login-captcha/compare/2.1.1...2.1.2
[2.1.1]: https://github.com/guanguans/dcat-login-captcha/compare/2.1.0...2.1.1
[2.1.0]: https://github.com/guanguans/dcat-login-captcha/compare/2.0.1...2.1.0
[2.0.1]: https://github.com/guanguans/dcat-login-captcha/compare/2.0.0...2.0.1
[2.0.0]: https://github.com/guanguans/dcat-login-captcha/compare/2.0.0-rc2...2.0.0
[2.0.0-rc2]: https://github.com/guanguans/dcat-login-captcha/compare/2.0.0-rc1...2.0.0-rc2
[2.0.0-rc1]: https://github.com/guanguans/dcat-login-captcha/compare/v1.1.0...2.0.0-rc1
[v1.1.0]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.19...v1.1.0
[v1.0.19]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.18...v1.0.19
[v1.0.18]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.17...v1.0.18
[v1.0.17]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.16...v1.0.17
[v1.0.16]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.15...v1.0.16
[v1.0.15]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.14...v1.0.15
[v1.0.14]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.13...v1.0.14
[v1.0.13]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.12...v1.0.13
[v1.0.12]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.11...v1.0.12
[v1.0.11]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.10...v1.0.11
[v1.0.10]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.9...v1.0.10
[v1.0.9]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.8...v1.0.9
[v1.0.8]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.7...v1.0.8
[v1.0.7]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.6...v1.0.7
[v1.0.6]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.5...v1.0.6
[v1.0.5]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.4...v1.0.5
[v1.0.4]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.3...v1.0.4
[v1.0.3]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.2...v1.0.3
[v1.0.2]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.1...v1.0.2
[v1.0.1]: https://github.com/guanguans/dcat-login-captcha/compare/v1.0.0...v1.0.1
