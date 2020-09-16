<?php

namespace JustSteveKing\CompaniesHouseLaravel\Tests;

use JustSteveKing\CompaniesHouseLaravel\CompaniesHouseLaravelServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        try {
            $env = parse_ini_file(__DIR__ . '/../.env');
            if (isset($env['COMPANIES_HOUSE_KEY'])) {
                $this->app['config']->set('companies-house-laravel.api.key', $env['COMPANIES_HOUSE_KEY']);
            }

            if (isset($env['COMPANIES_HOUSE_URL'])) {
                $this->app['config']->set('companies-house-laravel.api.url', $env['COMPANIES_HOUSE_URL']);
            }
        } catch (\Exception $e) {
            //
        }
    }

    protected function getPackageProviders($app)
    {
        return [
            CompaniesHouseLaravelServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
//        $app['config']->set('database.default', 'sqlite');
//        $app['config']->set('database.connections.sqlite', [
//            'driver' => 'sqlite',
//            'database' => ':memory:',
//            'prefix' => '',
//        ]);
//
    }
}
