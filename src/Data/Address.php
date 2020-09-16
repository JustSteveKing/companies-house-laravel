<?php

namespace JustSteveKing\CompaniesHouseLaravel\Data;

class Address
{
    /**
     * @var string|null
     */
    public ?string $postalCode;

    /**
     * @var string|null
     */
    public ?string $locality;

    /**
     * @var string|null
     */
    public ?string $country;

    /**
     * @var string|null
     */
    public ?string $line1;

    /**
     * @var string|null
     */
    public ?string $line2;

    /**
     * @var string|null
     */
    public ?string $full;

    /**
     * Address constructor.
     * @param array $data
     */
    private function __construct(array $data)
    {
        $this->postalCode = $data['registered_office_address']['postal_code'] ?? null;
        $this->locality = $data['registered_office_address']['locality'] ?? null;
        $this->country = $data['registered_office_address']['country'] ?? null;
        $this->line1 = $data['registered_office_address']['address_line_1'] ?? null;
        $this->line2 = $data['registered_office_address']['address_line_2'] ?? null;
        $this->full = $this->makeAddress();
    }

    /**
     * @param array $data
     * @return self
     */
    public static function make(array $data): self
    {
        return new self($data);
    }

    /**
     * @return string
     */
    private function makeAddress(): string
    {
        return "{$this->line1}, {$this->line2}, {$this->locality}, {$this->postalCode}, {$this->country}";
    }
}
