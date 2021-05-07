<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class DateOfBirth extends DataTransferObject
{
    public null|int $month;
    public null|int $year;

    public static function hydrate(array $item): self
    {
        return new self(
            month: $item['month'] ?? null,
            year: $item['year'] ?? null,
        );
    }
}
