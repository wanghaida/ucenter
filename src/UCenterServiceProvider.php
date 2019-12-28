<?php

namespace Haaid\UCenter;

use Illuminate\Support\ServiceProvider;

class UCenterServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/ucenter.php' => config_path('ucenter.php'),
        ]);

        $this->mergeConfigFrom(__DIR__.'/config/ucenter.php', 'ucenter');
    }

    public function register()
    {
        $this->app->bind('ucenter', function () {
            return new UCenter;
        });

        $this->app->bind('Haaid\UCenter\Contracts\Api', config('ucenter.service'));
    }
}
