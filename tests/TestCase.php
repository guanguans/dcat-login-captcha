<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
/** @noinspection PhpFieldAssignmentTypeMismatchInspection */
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpVoidFunctionResultUsedInspection */
/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection PhpMissingParentCallCommonInspection */
/** @noinspection PhpUnusedAliasInspection */
declare(strict_types=1);

/**
 * Copyright (c) 2021-2026 guanguans<ityaozm@gmail.com>
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/guanguans/dcat-login-captcha
 */

namespace Guanguans\DcatLoginCaptchaTests;

use Dcat\Admin\Admin;
use Dcat\Admin\Http\Controllers\AuthController;
use Guanguans\DcatLoginCaptcha\Facades\CaptchaBuilder;
use Guanguans\DcatLoginCaptcha\Facades\PhraseBuilder;
use Guanguans\DcatLoginCaptcha\LoginCaptchaServiceProvider;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
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

class TestCase extends \Orchestra\Testbench\TestCase
{
    // use DatabaseMigrations;
    // use DatabaseTransactions;
    // use DatabaseTruncation;
    // use InteractsWithViews;
    // use LazilyRefreshDatabase;
    // use WithCachedConfig;
    // use WithCachedRoutes;

    // use VarDumperTestTrait;
    // use PHPMock;

    // use RefreshDatabase;
    use WithWorkbench;

    /**
     * Performs assertions shared by all tests of a test case.
     *
     * This method is called between setUp() and test.
     */
    protected function assertPreConditions(): void {}

    /**
     * Performs assertions shared by all tests of a test case.
     *
     * This method is called between test and tearDown().
     *
     * @see \Mockery\Adapter\Phpunit\MockeryPHPUnitIntegrationAssertPostConditions::assertPostConditions()
     * @see \Mockery\Adapter\Phpunit\MockeryTestCase
     */
    protected function assertPostConditions(): void {}

    protected function getApplicationTimezone(mixed $app): string
    {
        return 'Asia/Shanghai';
    }

    /**
     * @return array<string, class-string>
     */
    protected function getPackageAliases(mixed $app): array
    {
        return [
            'CaptchaBuilder' => CaptchaBuilder::class,
            'PhraseBuilder' => PhraseBuilder::class,
        ];
    }

    protected function defineEnvironment(mixed $app): void
    {
        tap($app, static function (): void {
            // File::delete(glob(storage_path('logs/*.log')));
            Mail::fake();
            // Queue::fake();
        });

        tap($app->make(Repository::class), static function (Repository $repository): void {
            $repository->set('app.key', 'base64:UZ5sDPZSB7DSLKY+DYlU8G/V1e/qW+Ag0WF03VNxiSg=');
            $repository->set('app.debug', false);

            $repository->set('database.default', 'sqlite');
            $repository->set('database.connections.sqlite.database', ':memory:');

            $repository->set('mail.default', 'log');
            $repository->set('admin.auth.controller', AuthController::class);
        });
    }

    /**
     * @noinspection ForgottenDebugOutputInspection
     * @noinspection DebugFunctionUsageInspection
     */
    protected function installDcat(): void
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
