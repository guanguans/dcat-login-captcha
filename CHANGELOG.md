# Changelog

All notable changes to `guanguans/dcat-login-captcha` will be documented in this file.

## 1.0.0 - 2021-07-23

* Initial release.

## 1.0.1 - 2021-07-23

* Add default config file.
* Add annotation for facades.
* Optimize `login_captcha_check` function.
* Optimize captcha generate.
* Optimize get setting config.
* Rename `dcat_login_captcha_check`->`login_captcha_check`.
* Rename `dcat_login_captcha_url`->`login_captcha_url`.

## 1.0.2 - 2021-07-23

* Add login_captcha_get function.
* Update lang files.
* Update extension alias and description.
* Optimize LoginCaptchaServiceProvider.
* Optimize setting form.

## 1.0.3 - 2021-07-23

* Add CleanObContents Middleware.

## 1.0.4 - 2021-07-23

* Add SetResponseContentType Middleware.
* Add content type setting config.

## 1.0.5 - 2021-07-23

* Add BootingAdmin.

## 1.0.6 - 2021-07-26

* Rename src/BootingAdmin.php -> src/BootingHandler.php.
* Remove src/Http/Controllers/CaptchaController.php`.

## 1.0.7 - 2021-07-31

* Optimize `buildCaptchaJsScript`.

## 1.0.8 - 2021-09-13

* Fix cant match routing path(#8).
