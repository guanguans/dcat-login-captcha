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
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Symfony\Component\VarDumper\Test\VarDumperTestTrait;

/**
 * @internal
 *
 * @small
 * @coversNothing
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    use MockeryPHPUnitIntegration;
    use VarDumperTestTrait;

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
        // config()->set('login-captcha', 4);
    }

    protected function defineRoutes($router): void
    {
    }
}
