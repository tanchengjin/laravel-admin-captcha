<?php

namespace tanchengjin\LaravelAdmin\Captcha;

use Illuminate\Support\ServiceProvider;

class CaptchaServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Captcha $extension)
    {
        if (!config('admin.extensions.t-laravel-admin-captcha.enable', true)) {
            return;
        }

        if (!Captcha::boot()) {
            return;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'laravel-admin-captcha');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes([
                __DIR__ . '/../resources/lang/zh-CN/captcha.php' => resource_path('lang/zh-CN/captcha.php'),
                __DIR__ . '/../resources/lang/en/captcha.php' => resource_path('lang/en/captcha.php')
            ], 'lang');
        }

        $this->app->booted(function () {
            Captcha::routes(__DIR__ . '/../routes/web.php');
        });

        $this->app['router']->get('/captcha', function () {
            echo new \tanchengjin\captcha\Captcha(
                config('admin.extensions.t-laravel-admin-captcha.width', 100),
                config('admin.extensions.t-laravel-admin-captcha.height', 30),
                config('admin.extensions.t-laravel-admin-captcha.length', 4)
            );
            exit();
        });
    }
}
