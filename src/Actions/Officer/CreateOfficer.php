<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\Actions\Officer;

use JustSteveKing\CompaniesHouse\DTO\Officer;

class CreateOfficer
{
    /**
     * Handle the creation of an Officer
     *
     * @param Response $response
     *
     * @return Officer
     */
    public function handle(array $item): Officer
    {
        return Officer::hydrate(
            item: $item,
        );
    }
}
