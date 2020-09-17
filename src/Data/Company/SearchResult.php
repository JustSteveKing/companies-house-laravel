<?php

namespace JustSteveKing\CompaniesHouseLaravel\Data\Company;

use Carbon\Carbon;
use JustSteveKing\CompaniesHouseLaravel\Data\Address;

class SearchResult
{
    public ?string $status;

    public ?string $title;

    public ?string $number;

    public Address $address;

    public ?Carbon $created;

    /**
     * SearchResult constructor.
     * @param array $data
     */
    private function __construct(array $data)
    {
        $this->status = $data['company_status'];
        $this->title = $data['title'];
        $this->number = $data['company_number'];
        $this->address = Address::make($data);
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
