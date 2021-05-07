<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class Officer extends DataTransferObject
{
    public null|string $name;
    public null|string $role;
    public null|string $occupation;
    public null|string $nationality;
    public null|string $countryOfResidence;
    public null|Carbon $appointedOn;
    public null|Address $address;
    public null|DateOfBirth $dateOfBirth;

    public static function hydrate(array $item): self
    {
        return new self(
            name: $item['name'] ?? null,
            role: $item['officer_role'] ?? null,
            occupation: $item['occupation'] ?? null,
            nationality: $item['nationality'] ?? null,
            countryOfResidence: $item['country_of_residence'] ?? null,
            appointedOn: Carbon::parse($item['appointed_on']),
            address: Address::hydrate(
                item: $item['address'],
            ),
            dateOfBirth: DateOfBirth::hydrate(
                item: $item['date_of_birth'],
            ),
        );
    }
}
