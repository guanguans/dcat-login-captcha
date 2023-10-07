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
use Illuminate\Database\Migrations\Migration;

class UpdateAdminSettingsForDcatLoginCaptcha extends Migration
{
    public function getConnection()
    {
        return $this->config('database.connection', config('database.default'));
    }

    public function config($key, $default = null)
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

            $setting->value += config('login_captcha');
            $setting->save();
        } catch (Throwable $e) {
            logger()->error(sprintf('Dcat-login-captcha upgrade error error: %s', $e->getMessage()));
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
}
