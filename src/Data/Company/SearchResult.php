<?php

namespace JustSteveKing\CompaniesHouseLaravel\Data\Company;

use Carbon\Carbon;
use JustSteveKing\CompaniesHouseLaravel\Data\Address;

class SearchResult
{
    /**
     * @var string|null
     */
    public ?string $status;

    /**
     * @var string|null
     */
    public ?string $title;

    /**
     * @var string|null
     */
    public ?string $number;

    /**
     * @var Address|null
     */
    public ?Address $address;

    /**
     * @var Carbon|null
     */
    public ?Carbon $created;

    /**
     * SearchResult constructor.
     * @param array $data
     */
    private function __construct(array $data)
    {
        $this->status = $data['company_status'] ?? null;
        $this->title = $data['title'] ?? null;
        $this->number = $data['company_number'] ?? null;
        $this->address = Address::make($data['address'] ?? null);
        $this->created = Carbon::parse($data['date_of_creation'] ?? null);
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
