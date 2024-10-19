<?php

namespace KhantNyar\Laraflow;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use KhantNyar\Laraflow\Laraflow;

class LaraflowServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laraflow');
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'laraflow');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {
            // $this->publishes([
            //     __DIR__ . '/../config/config.php' => config_path('laraflow.php'),
            // ], 'config');

            // Publishing the views.

            $this->publishes([
                __DIR__ . '/../resources/views' => resource_path('views/vendor/laraflow'),
            ], 'views');
            Blade::anonymousComponentNamespace('laraflow.components', 'laraflow');

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laraflow'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laraflow'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'laraflow');

        // Register the main class to use with the facade
        $this->app->singleton('laraflow', function () {
            return new Laraflow;
        });
    }
}
