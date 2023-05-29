<?php

declare(strict_types=1);

namespace Maplerad\Laravel;

use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\ServiceProvider;
use Maplerad\Laravel\Contracts\MapleradClientContract;
use Maplerad\Laravel\Exceptions\ConfigurationException;
use Maplerad\Laravel\Transporters\MapleradClientTransporter;
use Maplerad\Laravel\ValueObjects\Transporter\BaseUri;

class MapleradServiceProvider extends ServiceProvider implements DeferrableProvider
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
        $this->configure()->bindMapleradClient();
    }

    /**
     * Bind the Maplerad Client.
     */
    protected function bindMapleradClient(): void
    {
        $this->app->singleton(MapleradClientContract::class, static function (Application $app) {
            $config = $app->make('config');

            if (empty($secretKey = $config->get('maplerad.secret_key'))) {
                throw ConfigurationException::noSecretKey();
            }

            return new MapleradClientTransporter(
                transporter: Http::baseUrl(
                    BaseUri::from($config->get('maplerad.domain'))->toString()
                )
                    ->asJson()
                    ->acceptJson()
                    ->timeout($config->get('maplerad.request_timeout', 30))
                    ->withToken($secretKey)
            );
        });

        $this->app->alias(MapleradClientContract::class, 'maplerad');
        $this->app->alias(MapleradClientContract::class, MapleradClientTransporter::class);
    }

    /**
     * Setup the configuration for Maplerad.
     */
    protected function configure(): static
    {
        $this->mergeConfigFrom(
            path: __DIR__.'/../config/maplerad.php',
            key: 'maplerad'
        );

        return $this;
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

    /**
     * Get the services provided by the provider.
     */
    public function provides(): array
    {
        return [
            MapleradClientContract::class
        ];
    }
}
