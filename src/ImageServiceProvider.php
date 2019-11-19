<?php

namespace Siaoynli\Compress;

use Illuminate\Support\ServiceProvider;

class ImageServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

        $this->app->singleton('image', function ($app) {
            return new Image($app['config']);
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // 发布配置文件
        $this->publishes([
            __DIR__ . '/config/compress-image.php' => config_path('compress-image.php'),
        ]);
    }

    public function provides()
    {
        return ['image'];
    }


}
