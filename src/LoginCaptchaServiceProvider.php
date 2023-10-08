<?php

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\DcatLoginCaptcha;

use Dcat\Admin\Admin;
use Dcat\Admin\Extend\ServiceProvider;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Support\Facades\Validator;

class LoginCaptchaServiceProvider extends ServiceProvider
{
    /**
     * @var string[]
     */
    protected $exceptRoutes = [
        'auth' => 'captcha/generate',
        'permission' => 'captcha/generate',
    ];

    public function init()
    {
        parent::init();
        $this->setupConfig();
        $this->loadMigrationsFrom(__DIR__.'/../updates/2022_08_31_164022_update_admin_settings_for_dcat_login_captcha.php');
        $this->extendValidator();
        Admin::booting($this->app->make(BootingHandler::class));
    }

    public function register()
    {
        $this->registerPhraseBuilder();
        $this->registerCaptchaBuilder();
    }

    /**
     * Register PhraseBuilder.
     */
    protected function registerPhraseBuilder()
    {
        $this->app->singleton(PhraseBuilder::class, function () {
            return new PhraseBuilder(static::setting('length'), static::setting('charset'));
        });

        $this->app->alias(PhraseBuilder::class, 'gregwar.phrase-builder');
    }

    /**
     * Register CaptchaBuilder.
     */
    protected function registerCaptchaBuilder()
    {
        $this->app->singleton(CaptchaBuilder::class, function ($app) {
            $builder = new CaptchaBuilder(null, $app[PhraseBuilder::class]);

            $builder->build(
                static::setting('width'),
                static::setting('height'),
                static::setting('font'),
                static::setting('fingerprint')
            );

            return $builder;
        });

        $this->app->alias(CaptchaBuilder::class, 'gregwar.captcha-builder');
    }

    /**
     * Set up the config.
     */
    protected function setupConfig()
    {
        $source = __DIR__.'/../config/login-captcha.php';

        $this->mergeConfigFrom($source, 'login-captcha');

        static::setting((array) static::setting() + (array) config('login-captcha', []));
    }

    /**
     * Extend validator rules.
     */
    protected function extendValidator()
    {
        Validator::extend('dcat_login_captcha', function ($attribute, $value) {
            return \login_captcha_check($value);
        }, static::trans('login_captcha.captcha_error'));
    }

    /**
     * Setting form.
     */
    public function settingForm()
    {
        return new Setting($this);
    }
}
