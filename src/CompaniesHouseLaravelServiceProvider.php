<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouseLaravel;

use Illuminate\Validation\Rule;
use Illuminate\Support\ServiceProvider;
use JustSteveKing\CompaniesHouseLaravel\Rules\CompanyNumber;

class CompaniesHouseLaravelServiceProvider extends ServiceProvider
{
    /**
     * inheritDoc
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/companies-house.php' => config_path('companies-house.php'),
            ], 'config');
        }

        Rule::macro('companyNumber', function () {
            return new CompanyNumber(
                client: resolve(Client::class),
            );
        });
    }

    /**
     * @inheritDoc
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/companies-house.php',
            'companies-house',
        );

        $this->app->singleton(Client::class, function ($app) {
            return new Client(
                url: config('companies-house.api.url'),
                apiKey: config('companies-house.api.key'),
                timeout: config('companies-house.api.timeout'),
                retryTimes: config('companies-house.api.retry.times'),
                retryMilliseconds: config('companies-house.api.retry.milliseconds'),
            );
        });
    }
}
