<?php

/** @noinspection AnonymousFunctionStaticInspection */
/** @noinspection NullPointerExceptionInspection */
/** @noinspection PhpFieldAssignmentTypeMismatchInspection */
/** @noinspection PhpPossiblePolymorphicInvocationInspection */
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUnhandledExceptionInspection */
/** @noinspection PhpVoidFunctionResultUsedInspection */
/** @noinspection StaticClosureCanBeUsedInspection */
/** @noinspection EfferentObjectCouplingInspection */
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
use Guanguans\DcatLoginCaptcha\Support\ComposerScripts;
use Illuminate\Config\Repository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Orchestra\Testbench\Concerns\WithWorkbench;
use PhpParser\Node;
use PhpParser\Node\Expr\Closure;
use PhpParser\Node\Expr\MethodCall;
use PhpParser\Node\Expr\Variable;
use PhpParser\Node\Scalar\String_;
use PhpParser\NodeTraverser;
use PhpParser\NodeVisitorAbstract;
use Rector\PhpParser\Node\NodeFactory;
use Rector\PhpParser\Parser\SimplePhpParser;
use Rector\PhpParser\Printer\BetterStandardPrinter;
use Symfony\Component\VarDumper\Test\VarDumperTestTrait;
use function Laravel\Prompts\error;
use function Laravel\Prompts\notify;

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
    protected function installDcat(): int
    {
        try {
            $this->fixDatabaseMigrations();
            // $this->loadMigrationsFrom(__DIR__.'/../vendor/dcat/laravel-admin/database/migrations');

            Artisan::call('admin:publish', ['--force' => false]);
            $status = Artisan::call('admin:install');

            // Artisan::call('admin:ext-install', ['name' => 'guanguans.dcat-login-captcha', ['--path' => __DIR__.'/../']]);
            // Artisan::call('admin:ext-enable', ['name' => 'guanguans.dcat-login-captcha']);

            resolve(LoginCaptchaServiceProvider::class)->init();

            return $status;
        } catch (\Throwable $throwable) {
            // error("Install Dcat Admin failed [{$throwable->getMessage()}].");
            dump("Install Dcat Admin failed [{$throwable->getMessage()}].");
            // notify("Install Dcat Admin failed [{$throwable->getMessage()}].");

            return 1;
        }
    }

    private function fixDatabaseMigrations(): void
    {
        $rectorConfig = ComposerScripts::makeRectorConfig();
        $nodeTraverser = new NodeTraverser(
            new class($rectorConfig->make(NodeFactory::class)) extends NodeVisitorAbstract {
                public function __construct(private readonly NodeFactory $nodeFactory) {}

                /**
                 * ```
                 * $table->dropColumn('show');
                 * $table->dropColumn('extension');
                 * ```
                 * to
                 * ```
                 * $table->dropColumn(['show', 'extension']);
                 * ```.
                 */
                public function enterNode(Node $node): void
                {
                    if (!$node instanceof Closure) {
                        return;
                    }

                    $exprNode = $node->stmts[0]->expr;

                    if (
                        $exprNode instanceof MethodCall
                        && $exprNode->var instanceof Variable
                        && 'table' === $exprNode->var->name
                        && 'dropColumn' === $exprNode->name->name
                        && $exprNode->args[0]->value instanceof String_
                    ) {
                        $exprNode->args[0]->value = $this->nodeFactory->createArray(['show', 'extension']);
                        unset($node->stmts[1]);
                    }
                }
            }
        );
        $migratedFile = __DIR__.'/../vendor/dcat/laravel-admin/database/migrations/2020_11_01_083237_update_admin_menu_table.php';
        $nodes = $nodeTraverser->traverse($rectorConfig->make(SimplePhpParser::class)->parseFile($migratedFile));
        File::put($migratedFile, $rectorConfig->make(BetterStandardPrinter::class)->prettyPrintFile($nodes));
    }
}
