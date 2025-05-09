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

use Dcat\Admin\Models\Setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Log;

class UpdateAdminSettingsForDcatLoginCaptcha extends Migration
{
    /**
     * @noinspection PhpMissingParentCallCommonInspection
     */
    public function getConnection(): string
    {
        return $this->config('database.connection', config('database.default'));
    }

    public function config(string $key, mixed $default = null): mixed
    {
        return config('admin.'.$key, $default);
    }

    /**
     * Run the migrations.
     */
    public function up(): void
    {
        try {
            $setting = Setting::query()
                ->where('slug', 'guanguans:dcat-login-captcha')
                ->firstOrFail()
                ->mergeCasts(['value' => 'array']);

            /** @noinspection PhpUndefinedFieldInspection */
            $setting->value += (array) config('login-captcha', []);
            $setting->save();
        } catch (Throwable $throwable) {
            Log::error('Dcat-login-captcha upgrade error.', ['throwable' => $throwable]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {}
}
