<?php

declare(strict_types=1);

/**
 * This file is part of the guanguans/dcat-login-captcha.
 *
 * (c) guanguans <ityaozm@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled.
 */

use Dcat\Admin\Models\Setting;
use Illuminate\Config\Repository;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Log;

class UpdateAdminSettingsForDcatLoginCaptcha extends Migration
{
    public function getConnection(): string
    {
        return $this->config('database.connection', config('database.default'));
    }

    /**
     * @param null|mixed $default
     *
     * @return Application|mixed|Repository
     */
    public function config(string $key, $default = null)
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
            $setting->value += config('login-captcha', []);
            $setting->save();
        } catch (Throwable $throwable) {
            Log::error('Dcat-login-captcha upgrade error.', ['throwable' => $throwable]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
}
