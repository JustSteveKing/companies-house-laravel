<?php

namespace JustSteveKing\CompaniesHouseLaravel\Data\Company;

use JustSteveKing\CompaniesHouseLaravel\Data\Address;

class CompanyOfficer
{
    /**
     * @var mixed|string
     */
    public string $name;

    /**
     * @var mixed|string
     */
    public string $role;

    /**
     * @var mixed|string|null
     */
    public ?string $occupation;

    /**
     * @var mixed|string|null
     */
    public ?string $countryOfResidency;

    /**
     * @var mixed|string|null
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
