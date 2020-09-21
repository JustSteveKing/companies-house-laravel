<?php

namespace JustSteveKing\CompaniesHouseLaravel\Data;

class ReferenceDate
{
    /**
     * @var string|null
     */
    public ?string $day;

    /**
     * @var string|null
     */
    public ?string $month;

    /**
     * ReferenceDate constructor.
     * @param array $data
     */
    private function __construct(array $data)
    {
        $this->day = $data['accounts']['accounting_reference_date']['day'] ?? null;
        $this->month = $data['accounts']['accounting_reference_date']['month'] ?? null;
    }

    /**
     * @param array $data
     * @return static
     */
    public static function make(array $data): self
    {
        return new self($data);
    }
}
