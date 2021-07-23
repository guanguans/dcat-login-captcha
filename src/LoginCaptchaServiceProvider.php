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
use Dcat\Admin\Support\Helper;
use Dcat\Admin\Traits\HasFormResponse;
use Gregwar\Captcha\CaptchaBuilder;
use Gregwar\Captcha\PhraseBuilder;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;

class LoginCaptchaServiceProvider extends ServiceProvider
{
    use HasFormResponse;

    /**
     * @var bool
     */
    protected $defer = true;

    /**
     * @var string[]
     */
    protected $exceptRoutes = [
        'auth' => 'captcha/generate',
        'permission' => 'captcha/generate',
    ];

    /**
     * {@inheritdoc}
     */
    public function register()
    {
        $this->registerPhraseBuilder();
        $this->registerCaptchaBuilder();
    }

    protected function registerPhraseBuilder()
    {
        $this->app->singleton(PhraseBuilder::class, function ($app) {
            return new PhraseBuilder(static::setting('length'), static::setting('charset'));
        });
        $this->app->alias(PhraseBuilder::class, 'gregwar.phrase-builder');
    }

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

    protected function buildCaptchaScript()
    {
        return (string) view('guanguans.dcat-login-captcha::captcha', [
            'captchaUrl' => \login_captcha_url(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        $this->setupConfig();

        Validator::extend('dcat_login_captcha', function ($attribute, $value, $parameters, \Illuminate\Validation\Validator $validator) {
            return \login_captcha_check($value);
        }, static::trans('login_captcha.captcha_error'));

        Admin::booting(function () {
            if (Helper::matchRequestPath('GET:admin/auth/login')) {
                Admin::script($this->buildCaptchaScript());
            }

            if (Helper::matchRequestPath('POST:admin/auth/login')) {
                $validator = Validator::make(Request::post(), ['captcha' => 'required|dcat_login_captcha']);

                $validator->fails() && $this->error($validator);
            }
        });
    }

    /**
     * Set up the config.
     */
    protected function setupConfig()
    {
        $source = __DIR__.'/../config/login_captcha.php';

        $this->mergeConfigFrom($source, 'login_captcha');

        static::setting() or static::setting(config('login_captcha'));
    }

    /**
     * @param array|MessageBag|\Illuminate\Validation\Validator $validationMessages
     */
    protected function error($validationMessages)
    {
        throw new HttpResponseException($this->validationErrorsResponse($validationMessages));
    }

    public function settingForm()
    {
        return new Setting($this);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            PhraseBuilder::class,
            'gregwar.phrase-builder',
            CaptchaBuilder::class,
            'gregwar.captcha-builder',
        ];
    }
}
