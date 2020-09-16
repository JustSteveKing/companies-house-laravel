<?php

namespace JustSteveKing\CompaniesHouseLaravel;

use Illuminate\Support\Facades\Facade;

/**
 * @codeCoverageIgnore
 * @see \JustSteveKing\CompaniesHouseLaravel\Client
 */
class ClientFacade extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'client';
    }
}