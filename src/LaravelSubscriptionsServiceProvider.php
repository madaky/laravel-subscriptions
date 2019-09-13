<?php

namespace kbtechlabs\laravelSubscriptions;

use Illuminate\Support\ServiceProvider;

class LaravelSubscriptionsServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'kbtechlabs');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'kbtechlabs');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');
         $this->app['router']->namespace('kbtechlabs\\LaravelSubscriptions\\Controllers')
                ->middleware(['web'])
                ->group(function () {
                    $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            });
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-subscriptions.php', 'laravel-subscriptions');

        // Register the service the package provides.
        $this->app->singleton('laravel-subscriptions', function ($app) {
            return new laravel-subscriptions;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-subscriptions'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravel-subscriptions.php' => config_path('laravel-subscriptions.php'),
        ], 'laravel-subscriptions.config');

        //publishing migration
        $this->publishes([
                __DIR__ . '/../database/migrations/' => database_path('migrations'),
            ], 'migrations');    
        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/kbtechlabs'),
        ], 'laravel-subscriptions.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/kbtechlabs'),
        ], 'laravel-subscriptions.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/kbtechlabs'),
        ], 'laravel-subscriptions.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
