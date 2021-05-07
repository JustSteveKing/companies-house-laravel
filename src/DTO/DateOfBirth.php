<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class DateOfBirth extends DataTransferObject
{
    /**
     * @var null|int
     */
    public null|int $month;

    /**
     * @var null|int
     */
    public null|int $year;

    /**
     * Hydrate DateOfBirth
     *
     * @param array $item
     *
     * @return self
     */
    public static function hydrate(null|array $item = null): self
    {
        return new self(
            month: $item['month'] ?? null,
            year: $item['year'] ?? null,
        );
    }
}
