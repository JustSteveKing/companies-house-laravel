<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use JustSteveKing\CompaniesHouse\CompaniesHouseServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();

        $env = parse_ini_file(__DIR__ . '/../.env');

        $this->app['config']->set(
            'companies-house.api.key',
            $env['COMPANIES_HOUSE_KEY'],
        );
        $this->app['config']->set(
            'companies-house.api.url',
            $env['COMPANIES_HOUSE_URL'],
        );
        $this->app['config']->set(
            'companies-house.api.timeout',
            $env['COMPANIES_HOUSE_TIMEOUT'],
        );
        $this->app['config']->set(
            'companies-house.api.retry.times',
            $env['COMPANIES_HOUSE_RETRY_TIMES'],
        );
        $this->app['config']->set(
            'companies-house.api.retry.milliseconds',
            $env['COMPANIES_HOUSE_RETRY_MILLISECONDS'],
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            CompaniesHouseServiceProvider::class,
        ];
    }
}
