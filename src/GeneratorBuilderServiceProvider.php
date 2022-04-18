<?php

namespace Hublinkaz\GeneratorBuilder;

use Illuminate\Support\ServiceProvider;
use Hublinkaz\GeneratorBuilder\Commands\GeneratorBuilderRoutesPublisherCommand;

class GeneratorBuilderServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__.'/../config/generator_builder.php';

        $this->publishes([
            $configPath => config_path('hublinkaz/generator_builder.php'),
        ]);

        $this->loadViewsFrom(__DIR__.'/../views/', 'generator-builder');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('hublinkaz.publish.generator-builder', function ($app) {
            return new GeneratorBuilderRoutesPublisherCommand();
        });

        $this->commands([
            'hublinkaz.publish.generator-builder',
        ]);
    }
}
