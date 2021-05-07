<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class Address extends DataTransferObject
{
    /**
     * @var null|string
     */
    public null|string $postalCode;

    /**
     * @var null|string
     */
    public null|string $locality;

    /**
     * @var null|string
     */
    public null|string $premises;

    /**
     * @var null|string
     */
    public null|string $country;

    /**
     * @var null|string
     */
    public null|string $addressLine1;

    /**
     * @var null|string
     */
    public null|string $addressLine2;

    /**
     * Hydrate Address
     *
     * @param array $item
     *
     * @return self
     */
    public static function hydrate(array $item): self
    {
        return new self(
            postalCode: $item['postal_code'] ?? null,
            locality: $item['locality'] ?? null,
            premises: $item['premises'] ?? null,
            country: $item['country'] ?? null,
            addressLine1: $item['address_line_1'] ?? null,
            addressLine2: $item['address_line_2'] ?? null,
        );
    }
}
