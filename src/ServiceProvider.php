<?php

namespace Reviewsio;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/reviewsio.php' => config_path('reviewsio.php'),
            ], 'config');

            $this->commands([
                //
            ]);
        }
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/reviewsio.php', 'reviewsio');

        $this->app->bind(Reviewsio::class, function ($app) {
            return new Reviewsio(
                config('reviewsio.api'),
            );
        });
    }
}
