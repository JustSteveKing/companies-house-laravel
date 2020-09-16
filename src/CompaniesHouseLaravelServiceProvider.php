<?php

namespace JustSteveKing\CompaniesHouseLaravel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rule;
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
                __DIR__ . '/../config/companies-house-laravel.php' => config_path('companies-house-laravel.php'),
            ], 'config');
        }

        Rule::macro('companyNumber', function () {
            return new CompanyNumber(Client::make());
        });
    }

    /**
     * @inheritDoc
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/companies-house-laravel.php', 'companies-house-laravel');
    }
}
