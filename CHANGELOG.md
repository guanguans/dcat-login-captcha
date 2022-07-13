# Changelog

All notable changes to `guanguans/dcat-login-captcha` will be documented in this file.

## 1.0.14 - 2022-07-13

* Rename login_captcha_get -> login_captcha_content.
* Update github config files.

## 1.0.13 - 2022-05-03

* Update JS.

## 1.0.12 - 2022-04-06

* Bump codecov/codecov-action from 2.1.0 to 3.
* Update author info.

## 1.0.11 - 2022-04-01

* Rename `phrase_session_key` -> `captcha_phrase_session_key`.
* Generate captcha random url.
* Replace `Closure routing` -> `CaptchaController`.
* Bump actions/cache from 2 to 3.
* Bump actions/checkout from 2 to 3.
* Update overtrue/phplint requirement from ^2.3 || ^3.0 to ^2.3 || ^3.0 || ^4.0.

## 1.0.10 - 2021-11-9

* Compatible callback type.

## 1.0.9 - 2021-10-17

* Add parameters to the `SetResponseContentType` middleware.
* Update github config files.
* Update phpunit/phpunit requirement from ^7.0 || ^8.0 to ^7.0 || ^8.0 || ^9.0.
* Optimize booting `BootingHandler`.
* Optimize setting form .

## 1.0.8 - 2021-09-13

* Fix cant match routing path(#8).

## 1.0.7 - 2021-07-31

* Optimize `buildCaptchaJsScript`.

## 1.0.6 - 2021-07-26

* Rename src/BootingAdmin.php -> src/BootingHandler.php.
* Remove src/Http/Controllers/CaptchaController.php`.

## 1.0.5 - 2021-07-23

* Add BootingAdmin.

## 1.0.4 - 2021-07-23

* Add SetResponseContentType Middleware.
* Add content type setting config.

## 1.0.3 - 2021-07-23

* Add CleanObContents Middleware.

## 1.0.2 - 2021-07-23

* Add login_captcha_get function.
* Update lang files.
* Update extension alias and description.
* Optimize LoginCaptchaServiceProvider.
* Optimize setting form.

## 1.0.1 - 2021-07-23

* Add default config file.
* Add annotation for facades.
* Optimize `login_captcha_check` function.
* Optimize captcha generate.
* Optimize get setting config.
* Rename `dcat_login_captcha_check`->`login_captcha_check`.
* Rename `dcat_login_captcha_url`->`login_captcha_url`.

## 1.0.0 - 2021-07-23

* Initial release.
