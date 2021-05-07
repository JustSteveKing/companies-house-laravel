<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\Actions\Officer;

use JustSteveKing\CompaniesHouse\DTO\Officer;

class CreateOfficer
{
    public function handle(array $item): Officer
    {
        return Officer::hydrate(
            item: $item,
        );
    }
}
