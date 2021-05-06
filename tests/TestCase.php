<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouseLaravel\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use JustSteveKing\CompaniesHouseLaravel\CompaniesHouseLaravelServiceProvider;

class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
    }

    protected function getPackageProviders($app)
    {
        return [
            CompaniesHouseLaravelServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        $env = parse_ini_file(__DIR__ . '/../.env');

        if(! $env) {
            $env = parse_ini_file(__DIR__ . '/../.env.ci');
        }

        $app['config']->set(
            'companies-house.companies-house.api.key',
            $env['COMPANIES_HOUSE_KEY'],
        );
        $app['config']->set(
            'companies-house.companies-house.api.url',
            $env['COMPANIES_HOUSE_URL'],
        );
        $app['config']->set(
            'companies-house.companies-house.api.timeout',
            $env['COMPANIES_HOUSE_TIMEOUT'],
        );
        $app['config']->set(
            'companies-house.companies-house.api.retry.times',
            $env['COMPANIES_HOUSE_RETRY_TIMES'],
        );
        $app['config']->set(
            'companies-house.companies-house.api.retry.milliseconds',
            $env['COMPANIES_HOUSE_RETRY_MILLISECONDS'],
        );
    }
}
