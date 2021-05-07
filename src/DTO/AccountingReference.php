<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class AccountingReference extends DataTransferObject
{
    /**
     * @var null|string
     */
    public null|string $day;

    /**
     * @var null|string
     */
    public null|string $month;

    /**
     * Hydrate AccountingReference
     *
     * @param array $item
     *
     * @return self
     */
    public static function hydrate(array $item): self
    {
        return new self(
            day: $item['day'],
            month: $item['month'],
        );
    }
}
