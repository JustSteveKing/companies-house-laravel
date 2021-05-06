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
     * @param array|null $data
     */
    private function __construct(?array $data)
    {
        $this->postalCode = isset($data['postal_code']) ? $data['postal_code'] : null;
        $this->locality = isset($data['locality']) ? $data['locality'] : null;
        $this->country = isset($data['country']) ? $data['country'] : null;
        $this->line1 = isset($data['address_line_1']) ? $data['address_line_1'] : null;
        $this->line2 = isset($data['address_line_2']) ? $data['address_line_2'] : null;
        $this->full = $this->makeAddress();
    }

    /**
     * @param array|null $data
     * @return static
     */
    public static function make(?array $data): self
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
