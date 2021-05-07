<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\Concerns;

use Illuminate\Http\Client\Factory;
use Illuminate\Support\Facades\Http;

trait HasFake
{
    /**
     * Proxies a fake call to Illuminate\Http\Client\Factory::fake()
     *
     * @param null|callable|array $callback
     *
     * @return Factory
     */
    public static function fake(
        null|callable|array $callback = null,
    ): Factory {
        return Http::fake($callback);
    }
}
