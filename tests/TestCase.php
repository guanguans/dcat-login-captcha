<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

namespace Guanguans\DcatLoginCaptcha\Tests;

use Dcat\Admin\AdminServiceProvider;
use Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Orchestra\Testbench\Concerns\WithWorkbench;
use Symfony\Component\VarDumper\Test\VarDumperTestTrait;

/**
 * @internal
 *
 * @small
 * @coversNothing
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    // use DatabaseTransactions;
    // use RefreshDatabase;
    use MockeryPHPUnitIntegration;
    use VarDumperTestTrait;
    use WithWorkbench;

    protected function setUp(): void
    {
        parent::setUp();
        $this->startMockery();
    }

    protected function tearDown(): void
    {
        $this->closeMockery();
        parent::tearDown();
    }

    protected function getPackageProviders($app): array
    {
        return [
            AdminServiceProvider::class,
            LoginCaptchaServiceProvider::class,
        ];
    }

    protected function defineEnvironment($app): void
    {
        tap($app['config'], static function (Repository $config): void {
            $config->set('database.default', 'sqlite');
            $config->set('database.connections.sqlite', [
                'driver' => 'sqlite',
                'database' => ':memory:',
                // 'database' => __DIR__.'/Fixtures/database.sqlite',
                'prefix' => '',
            ]);
        });
    }

    protected function defineDatabaseMigrations(): void
    {
        // $this->loadMigrationsFrom(__DIR__.'/../vendor/dcat/laravel-admin/database/migrations');
    }

    protected function defineRoutes($router): void
    {
    }
}
