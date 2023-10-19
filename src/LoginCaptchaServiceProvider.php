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
use Dcat\Admin\Support\Helper;
use Dcat\Admin\Traits\HasFormResponse;
use Illuminate\Foundation\Application;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginCaptchaServiceProvider extends ServiceProvider
{
    use HasFormResponse;

    /** @var bool */
    protected $defer = false;

    public function register(): void
    {
        $this->setupConfig()
            ->registerPhraseBuilder()
            ->registerCaptchaBuilder();
    }

    public function init(): void
    {
        $this->exceptRoutes = [
            'auth' => $uri = self::setting('route.uri'),
            'permission' => $uri,
        ];

        parent::init();

        $this->setupConfig()
            ->publishView()
            ->loadMigrations()
            ->extendValidator()
            ->bootingCaptcha();
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

    /**
     * @noinspection RealpathInStreamContextInspection
     */
    protected function setupConfig(): self
    {
        $this->mergeConfigFrom(
            $source = realpath($raw = __DIR__.'/../config/login-captcha.php') ?: $raw,
            'login-captcha'
        );

        if ($this->app->runningInConsole()) {
            $this->publishes([$source => config_path('login-captcha.php')], 'dcat-login-captcha');
        }

        return $this;
    }

    protected function publishView(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [$this->getViewPath() => resource_path(sprintf('views/vendor/%s', $this->getName()))],
                'dcat-login-captcha'
            );
        }

        return $this;
    }

    /**
     * 初始化配置.
     */
    protected function initConfig(): void
    {
        parent::initConfig();
        $this->config += config('login-captcha', []);
    }

    protected function registerPhraseBuilder(): self
    {
        $this->app->singleton(PhraseBuilder::class, static function (): PhraseBuilder {
            return new PhraseBuilder(self::setting('length'), self::setting('charset'));
        });

        $this->alias(PhraseBuilder::class);

        return $this;
    }

    protected function registerCaptchaBuilder(): self
    {
        $this->app->singleton(CaptchaBuilder::class, static function (Application $app): CaptchaBuilder {
            $captchaBuilder = new CaptchaBuilder(null, $app->get(PhraseBuilder::class));
            $captchaBuilder->build(
                self::setting('width'),
                self::setting('height'),
                self::setting('font'),
                self::setting('fingerprint')
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
        }, self::trans('login-captcha.captcha_error'));

        return $this;
    }

    /**
     * @psalm-suppress InvalidCast
     * @psalm-suppress InvalidArgument
     */
    protected function bootingCaptcha(): self
    {
        Admin::booting(function (): void {
            $this->config = array_replace_recursive($this->config, config('admin.login_captcha', []));
            if (! self::setting('enabled')) {
                return;
            }

            $loginPath = ltrim(admin_base_path('auth/login'), '/');
            if (Helper::matchRequestPath("GET:$loginPath")) {
                Admin::script((string) view(sprintf('%s::captcha', $this->getName())));
            }

            if (Helper::matchRequestPath("POST:$loginPath")) {
                $validator = Validator::make(Request::post(), [
                    'captcha' => 'required|dcat_login_captcha',
                ]);

                if ($validator->fails()) {
                    throw new HttpResponseException($this->validationErrorsResponse($validator));
                }
            }
        });

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
            ->start('\\DcatLoginCaptcha')
            ->replaceFirst('\\', '')
            ->explode('\\')
            ->map(static function (string $name): string {
                return Str::snake($name, '-');
            })
            ->implode('.');
    }
}
