<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection SqlResolve */
/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection PhpUnusedAliasInspection */
declare(strict_types=1);

/**
 * Copyright (c) 2021-2025 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/dcat-login-captcha
 */

namespace Guanguans\DcatLoginCaptchaTests;

use Dcat\Admin\Admin;
use Dcat\Admin\AdminServiceProvider;
use Dcat\Admin\Http\Controllers\AuthController;
use Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Mockery\Adapter\Phpunit\MockeryPHPUnitIntegration;
use Orchestra\Testbench\Concerns\WithWorkbench;
use PhpParser\Node;
use PhpParser\Node\ArrayItem;
use PhpParser\Node\Expr\Array_;
use PhpParser\Node\Expr\Closure;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Scalar\String_;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use PhpParser\ParserFactory;
use PhpParser\PrettyPrinter\Standard;
use Symfony\Component\VarDumper\Test\VarDumperTestTrait;

/**
 * @small
 *
 * @coversNothing
 */
class TestCase extends \Orchestra\Testbench\TestCase
{
    // use DatabaseTransactions;
    // use RefreshDatabase;
    // use WithWorkbench;
    use MockeryPHPUnitIntegration;
    use VarDumperTestTrait;

    /**
     * @noinspection MethodVisibilityInspection
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->startMockery();
        $this->install();
    }

    /**
     * @noinspection MethodVisibilityInspection
     */
    protected function tearDown(): void
    {
        $this->closeMockery();
        parent::tearDown();
    }

    /**
     * @noinspection MethodVisibilityInspection
     * @noinspection PhpMissingParentCallCommonInspection
     */
    protected function getPackageProviders(mixed $app): array
    {
        return [
            AdminServiceProvider::class,
            LoginCaptchaServiceProvider::class,
        ];
    }

    /**
     * @noinspection MethodVisibilityInspection
     * @noinspection PhpMissingParentCallCommonInspection
     */
    protected function defineEnvironment(mixed $app): void
    {
        tap($app->make(\Illuminate\Contracts\Config\Repository::class), static function (Repository $repository): void {
            $repository->set('database.default', 'sqlite');
            $repository->set('database.connections.sqlite', [
                'driver' => 'sqlite',
                'database' => ':memory:',
                // 'database' => __DIR__.'/Fixtures/database.sqlite',
                'prefix' => '',
            ]);

            $repository->set('admin.auth.controller', AuthController::class);
        });
    }

    /**
     * @noinspection ForgottenDebugOutputInspection
     * @noinspection DebugFunctionUsageInspection
     */
    private function install(): void
    {
        $this->fixDatabaseMigrations();

        try {
            // $this->loadMigrationsFrom(__DIR__.'/../vendor/dcat/laravel-admin/database/migrations');
            Artisan::call('admin:publish', ['--force' => false]);
            Artisan::call('admin:install');
            // Artisan::call('admin:ext-install', ['name' => 'guanguans.dcat-login-captcha', ['--path' => __DIR__.'/../']]);
            // Artisan::call('admin:ext-enable', ['name' => 'guanguans.dcat-login-captcha']);
            resolve(LoginCaptchaServiceProvider::class)->init();
        } catch (\Throwable $throwable) {
            dump($throwable->getMessage());
        }
    }

    private function fixDatabaseMigrations(): void
    {
        $nodeTraverser = new NodeTraverser;
        $nodeTraverser->addVisitor(new class extends NodeVisitorAbstract {
            /**
             * @noinspection PhpMissingParentCallCommonInspection
             */
            public function enterNode(Node $node): void
            {
                if ($node instanceof Closure) {
                    $expr = $node->stmts[0]->expr;

                    if (
                        $expr instanceof MethodCall
                        && $expr->var instanceof Variable
                        && 'table' === $expr->var->name
                        && 'dropColumn' === $expr->name->name
                        && $expr->args[0]->value instanceof String_
                    ) {
                        $expr->args[0]->value = new Array_([
                            new ArrayItem(new String_('show')),
                            new ArrayItem(new String_('extension')),
                        ]);

                        unset($node->stmts[1]);
                    }
                }
            }
        });

        $migratedFile = __DIR__.'/../vendor/dcat/laravel-admin/database/migrations/2020_11_01_083237_update_admin_menu_table.php';
        $stmts = (new ParserFactory)->createForHostVersion()->parse(File::get($migratedFile));
        $nodeTraverser->traverse($stmts);
        File::put($migratedFile, (new Standard)->prettyPrintFile($stmts));
    }
}
