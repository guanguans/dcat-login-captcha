<?php

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
     *
     * @return void
     */
    public function up()
    {
        $setting = Setting::query()
            ->where('slug', 'guanguans:dcat-login-captcha')
            ->firstOrFail()
            ->mergeCasts(['value' => 'array']);

        $setting->value += config('login_captcha');
        $setting->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
