<?php

namespace Maplerad\Laravel;

use Illuminate\Support\ServiceProvider;

class MapleradServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPublishing();
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->configure();
    }

    /**
     * Setup the configuration for Maplerad.
     */
    protected function configure(): void
    {
        $this->mergeConfigFrom(
            path: __DIR__.'/../config/maplerad.php',
            key: 'maplerad'
        );
    }

    /**
     * Register the package's publishable resources.
     */
    protected function registerPublishing(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/maplerad.php' => $this->app->configPath('maplerad.php'),
            ], 'maplerad-config');
        }
    }
}
