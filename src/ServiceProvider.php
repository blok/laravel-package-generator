<?php

namespace Blok\LaravelPackageGenerator;

use Blok\LaravelPackageGenerator\Commands\PackageClone;
use Blok\LaravelPackageGenerator\Commands\PackageNew;
use Blok\LaravelPackageGenerator\Commands\PackageRemove;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    const CONFIG_PATH = __DIR__.'/../config/laravel-package-generator.php';

    public function boot()
    {
        $this->publishes([
            self::CONFIG_PATH => config_path('laravel-package-generator.php'),
        ], 'config');

        if ($this->app->runningInConsole()) {
            $this->commands([
                PackageNew::class,
                PackageRemove::class,
                PackageClone::class,
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(
            self::CONFIG_PATH,
            'laravel-package-generator'
        );
    }
}
