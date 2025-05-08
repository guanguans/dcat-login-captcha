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

namespace Guanguans\DcatLoginCaptcha\Tests;

use Dcat\Admin\Admin;
use Dcat\Admin\AdminServiceProvider;
use Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Orchestra\Testbench\Concerns\WithWorkbench;
use PhpParser\Node;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard;
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
    // use WithWorkbench;
    use MockeryPHPUnitIntegration;
    use VarDumperTestTrait;

    protected function setUp(): void
    {
        parent::setUp();
        $this->startMockery();
        $this->install();
    }

    protected function tearDown(): void
    {
        $this->closeMockery();
        parent::tearDown();
    }

    /**
     * @noinspection ForgottenDebugOutputInspection
     * @noinspection DebugFunctionUsageInspection
     */
    protected function install(): void
    {
        try {
            // $this->fixDatabaseMigrations();
            // $this->loadMigrationsFrom(__DIR__.'/../vendor/dcat/laravel-admin/database/migrations');
            Artisan::call('admin:publish', ['--force' => false]);
            Artisan::call('admin:install');
            // Artisan::call('admin:ext-install', ['name' => 'guanguans.dcat-login-captcha', ['--path' => __DIR__.'/../']]);
            // Artisan::call('admin:ext-enable', ['name' => 'guanguans.dcat-login-captcha']);
            app(LoginCaptchaServiceProvider::class)->init();
        } catch (\Throwable $throwable) {
            dump($throwable->getMessage());
        }
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

    protected function fixDatabaseMigrations(): void
    {
        $nodeTraverser = new NodeTraverser();
        $nodeTraverser->addVisitor(new class() extends NodeVisitorAbstract {
            public function enterNode(Node $node): void
            {
                if ($node instanceof \PhpParser\Node\Expr\Closure) {
                    $expr = $node->stmts[0]->expr;
                    if (
                        $expr instanceof Node\Expr\MethodCall
                        && $expr->var instanceof Node\Expr\Variable
                        && 'table' === $expr->var->name
                        && 'dropColumn' === $expr->name->name
                        && $expr->args[0]->value instanceof Node\Scalar\String_
                    ) {
                        $expr->args[0]->value = new Node\Expr\Array_([
                            new Node\Scalar\String_('show'),
                            new Node\Scalar\String_('extension'),
                        ]);

                        unset($node->stmts[1]);
                    }
                }
            }
        });

        $migratedFile = __DIR__.'/../vendor/dcat/laravel-admin/database/migrations/2020_11_01_083237_update_admin_menu_table.php';
        $stmts = (new ParserFactory())->create(1)->parse(File::get($migratedFile));
        $nodeTraverser->traverse($stmts);
        File::put($migratedFile, (new Standard())->prettyPrintFile($stmts));
    }
}
