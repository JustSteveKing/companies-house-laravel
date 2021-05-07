<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Spatie\DataTransferObject\DataTransferObject;

class Officer extends DataTransferObject
{
    /**
     * @var null|string
     */
    public null|string $name;

    /**
     * @var null|string
     */
    public null|string $role;

    /**
     * @var null|string
     */
    public null|string $occupation;

    /**
     * @var null|string
     */
    public null|string $nationality;

    /**
     * @var null|string
     */
    public null|string $countryOfResidence;

    /**
     * @var null|string
     */
    public null|string $appointmentId;

    /**
     * @var null|Carbon
     */
    public null|Carbon $appointedOn;

    /**
     * @var null|Address
     */
    public null|Address $address;

    /**
     * @var null|DateOfBirth
     */
    public null|DateOfBirth $dateOfBirth;

    /**
     * Hydrate Officer
     *
     * @param array $item
     *
     * @return self
     */
    public static function hydrate(array $item): self
    {
        return new self(
            name: $item['name'] ?? null,
            role: $item['officer_role'] ?? null,
            occupation: $item['occupation'] ?? null,
            nationality: $item['nationality'] ?? null,
            countryOfResidence: $item['country_of_residence'] ?? null,
            appointmentId: static::getAppointmentIdFromLinks($item['links']),
            appointedOn: Carbon::parse($item['appointed_on']),
            address: Address::hydrate(
                item: $item['address'],
            ),
            dateOfBirth: DateOfBirth::hydrate(
                item: $item['date_of_birth'] ?? null,
            ),
        );
    }

    /**
     * Get an Appointment ID from the Links array
     *
     * @param array $links
     *
     * return string
     */
    public static function getAppointmentIdFromLinks(array $links): string
    {
        return Str::after(
            subject: $links['self'],
            search: 'appointments/',
        );
    }
}
