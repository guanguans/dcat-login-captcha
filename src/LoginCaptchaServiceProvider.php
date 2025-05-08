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

namespace Guanguans\DcatLoginCaptcha;

use Dcat\Admin\Admin;
use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Support\Helper;
use Dcat\Admin\Traits\HasFormResponse;
use Guanguans\DcatLoginCaptcha\Exceptions\HttpResponseException;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use function Guanguans\DcatLoginCaptcha\Support\login_captcha_check;

class LoginCaptchaServiceProvider extends ServiceProvider
{
    use HasFormResponse;
    protected bool $defer = false;

    /**
     * @noinspection PhpMissingParentCallCommonInspection
     */
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

    /**
     * @noinspection PhpMissingParentCallCommonInspection
     */
    public function provides(): array
    {
        return [
            PhraseBuilder::class,
            CaptchaBuilder::class,
        ];
    }

    public function settingForm(): Setting
    {
        return new Setting($this);
    }

    /**
     * 初始化配置.
     *
     * @noinspection MethodVisibilityInspection
     */
    protected function initConfig(): void
    {
        parent::initConfig();
        $this->config += (array) config('login-captcha', []);
    }

    /**
     * @noinspection RealpathInStreamContextInspection
     */
    private function setupConfig(): self
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

    private function publishView(): self
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [$this->getViewPath() => resource_path(\sprintf('views/vendor/%s', $this->getName()))],
                'dcat-login-captcha'
            );
        }

        return $this;
    }

    private function registerPhraseBuilder(): self
    {
        $this->app->singleton(PhraseBuilder::class, static fn (): PhraseBuilder => new PhraseBuilder(self::setting('length'), self::setting('charset')));

        return $this;
    }

    private function registerCaptchaBuilder(): self
    {
        $this->app->singleton(CaptchaBuilder::class, static function (Application $application): CaptchaBuilder {
            $captchaBuilder = new CaptchaBuilder(null, $application->get(PhraseBuilder::class));
            $captchaBuilder->build(
                self::setting('width'),
                self::setting('height'),
                self::setting('font'),
                self::setting('fingerprint')
            );

            return $captchaBuilder;
        });

        return $this;
    }

    private function loadMigrations(): self
    {
        $this->loadMigrationsFrom(__DIR__.'/../updates/2022_08_31_164022_update_admin_settings_for_dcat_login_captcha.php');

        return $this;
    }

    private function extendValidator(): self
    {
        Validator::extend(
            'dcat_login_captcha',
            static fn (string $attribute, mixed $value): bool => login_captcha_check($value),
            self::trans('login-captcha.captcha_error')
        );

        return $this;
    }

    private function bootingCaptcha(): self
    {
        Admin::booting(function (): void {
            $this->config = array_replace_recursive($this->config, config('admin.login_captcha', []));

            if (!self::setting('enabled')) {
                return;
            }

            $loginPath = ltrim(admin_base_path('auth/login'), '/');

            if (Helper::matchRequestPath("GET:$loginPath")) {
                Admin::script((string) view(\sprintf('%s::captcha', $this->getName())));
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
}
