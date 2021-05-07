<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class AccountingReference extends DataTransferObject
{
    public null|string $day;
    public null|string $month;

    public static function hydrate(array $item): self
    {
        return new self(
            day: $item['day'],
            month: $item['month'],
        );
    }
}
