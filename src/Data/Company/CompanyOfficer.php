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
        $this->name = isset($data['name']) ? $data['name'] : null;
        $this->role = isset($data['officer_role']) ? $data['officer_role'] : null;
        $this->occupation = isset($data['occupation']) ? $data['occupation'] : null;
        $this->countryOfResidency = isset($data['country_of_residence']) ? $data['country_of_residence'] : null;
        $this->nationality = isset($data['nationality']) ? $data['nationality'] : null;
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
