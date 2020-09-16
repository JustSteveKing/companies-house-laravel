<?php

namespace JustSteveKing\CompaniesHouseLaravel;

use Illuminate\Support\ServiceProvider;
use Illuminate\Validation\Rule;
use JustSteveKing\CompaniesHouseLaravel\Rules\CompanyNumber;

class CompaniesHouseLaravelServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/companies-house-laravel.php' => config_path('companies-house-laravel.php'),
            ], 'config');
        }

        Rule::macro('company_number', function () {
            return new CompanyNumber(Client::make());
        });
    }

    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/companies-house-laravel.php', 'companies-house-laravel');
    }
}
