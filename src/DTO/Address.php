<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class Address extends DataTransferObject
{
    public null|string $postalCode;
    public null|string $locality;
    public null|string $premises;
    public null|string $country;
    public null|string $addressLine1;
    public null|string $addressLine2;

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
