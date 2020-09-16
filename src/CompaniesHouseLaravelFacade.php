<?php

namespace JustSteveKing\CompaniesHouseLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @codeCoverageIgnore
 * @see \JustSteveKing\CompaniesHouseLaravel\Client
 */
class CompaniesHouseLaravelFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'companies-house-laravel';
    }
}
