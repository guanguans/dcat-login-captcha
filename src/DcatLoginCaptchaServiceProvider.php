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

class DcatLoginCaptchaServiceProvider extends ServiceProvider
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
            return new PhraseBuilder(static::setting('length') ?? 4, static::setting('charset') ?? 'abcdefghijklmnpqrstuvwxyz23456789ABCDEFGHIJKLMNOPQRSTUVWXYZ');
        });
        $this->app->alias(PhraseBuilder::class, 'gregwar.phrase-builder');
    }

    protected function registerCaptchaBuilder()
    {
        $this->app->singleton(CaptchaBuilder::class, function ($app) {
            $builder = new CaptchaBuilder(null, $app[PhraseBuilder::class]);
            $builder->build(
                static::setting('width') ?? 150,
                static::setting('height') ?? 43,
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
            'captchaUrl' => admin_route('captcha.generate'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        Validator::extend('dcat_login_captcha', function ($attribute, $value, $parameters, \Illuminate\Validation\Validator $validator) {
            return \dcat_login_captcha_check($value);
        }, static::trans('login_captcha.captcha_error'));

        Admin::booting(function () {
            if (Helper::matchRequestPath('GET:admin/auth/login')) {
                Admin::script($this->buildCaptchaScript());
            }

            if (Helper::matchRequestPath('POST:admin/auth/login')) {
                $validator = Validator::make(Request::post(), ['captcha' => 'required|dcat_login_captcha']);

                $validator->fails() && $this->error($validator->errors()->first());
            }
        });
    }

    protected function error($error)
    {
        throw new HttpResponseException($this->validationErrorsResponse($error));
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
