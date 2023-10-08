<?php

declare(strict_types=1);

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
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginCaptchaServiceProvider extends ServiceProvider
{
    /** @var bool */
    protected $defer = false;

    /** @var array<string, string> */
    protected $exceptRoutes = [
        'auth' => 'captcha/generate',
        'permission' => 'captcha/generate',
    ];

    public function register(): void
    {
        $this->registerPhraseBuilder()
            ->registerCaptchaBuilder();
    }

    public function init(): void
    {
        parent::init();

        $this->setupConfig()
            ->loadMigrations()
            ->extendValidator()
            ->bootingAdmin();
    }

    public function provides(): array
    {
        return [
            $this->toAlias(PhraseBuilder::class),
            $this->toAlias(CaptchaBuilder::class),
            PhraseBuilder::class,
            CaptchaBuilder::class,
        ];
    }

    public function settingForm(): Setting
    {
        return new Setting($this);
    }

    protected function setupConfig(): self
    {
        $this->mergeConfigFrom(realpath($raw = __DIR__.'/../config/login-captcha.php') ?: $raw, 'login-captcha');
        static::setting((array) static::setting() + (array) config('login-captcha', []));

        return $this;
    }

    protected function registerPhraseBuilder(): self
    {
        $this->app->singleton(PhraseBuilder::class, static function (): PhraseBuilder {
            return new PhraseBuilder(static::setting('length'), static::setting('charset'));
        });

        $this->alias(PhraseBuilder::class);

        return $this;
    }

    protected function registerCaptchaBuilder(): self
    {
        $this->app->singleton(CaptchaBuilder::class, static function (Application $app): CaptchaBuilder {
            $captchaBuilder = new CaptchaBuilder(null, $app->get(PhraseBuilder::class));
            $captchaBuilder->build(
                static::setting('width'),
                static::setting('height'),
                static::setting('font'),
                static::setting('fingerprint')
            );
            return $captchaBuilder;
        });

        $this->alias(CaptchaBuilder::class);

        return $this;
    }

    protected function loadMigrations(): self
    {
        $this->loadMigrationsFrom(__DIR__.'/../updates/2022_08_31_164022_update_admin_settings_for_dcat_login_captcha.php');

        return $this;
    }

    protected function extendValidator(): self
    {
        Validator::extend('dcat_login_captcha', static function ($attribute, $value): bool {
            return login_captcha_check($value);
        }, static::trans('login_captcha.captcha_error'));

        return $this;
    }

    protected function bootingAdmin(): self
    {
        Admin::booting($this->app->make(BootingHandler::class));

        return $this;
    }

    /**
     * @param class-string $class
     */
    protected function alias(string $class): self
    {
        $this->app->alias($class, $this->toAlias($class));

        return $this;
    }

    /**
     * @param class-string $class
     */
    protected function toAlias(string $class): string
    {
        return str($class)
            ->replaceFirst(__NAMESPACE__, '')
            ->start('\\DcatLoginCaptcha\\')
            ->replaceFirst('\\', '')
            ->explode('\\')
            ->map(static function (string $name): string {
                return Str::snake($name, '-');
            })
            ->implode('.');
    }
}
