<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class Address extends DataTransferObject
{
    public string $postalCode;
    public string $locality;
    public string $premises;
    public string $country;
    public string $addressLine1;
}
