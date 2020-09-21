<?php

namespace JustSteveKing\CompaniesHouseLaravel\Data\Company;

use JustSteveKing\CompaniesHouseLaravel\Data\Address;

class CompanyOfficer
{
    /**
     * @var string|null
     */
    public ?string $name;

    /**
     * @var string|null
     */
    public ?string $role;

    /**
     * @var string|null
     */
    public ?string $occupation;

    /**
     * @var string|null
     */
    public ?string $countryOfResidency;

    /**
     * @var string|null
     */
    public ?string $nationality;

    /**
     * @var Address|null
     */
    public ?Address $address;

    /**
     * CompanyOfficer constructor.
     * @param array $data
     */
    private function __construct(array $data)
    {
        $this->name = $data['name'] ?? null;
        $this->role = $data['officer_role'] ?? null;
        $this->occupation = $data['occupation'] ?? null;
        $this->countryOfResidency = $data['country_of_residence'] ?? null;
        $this->nationality = $data['nationality'] ?? null;
        $this->address = Address::make($data['address']);
    }

    /**
     * @param array $data
     * @return static
     */
    public static function fromApi(array $data): self
    {
        return new self($data);
    }
}
