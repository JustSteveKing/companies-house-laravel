<?php

namespace JustSteveKing\CompaniesHouseLaravel\Data;

use Carbon\Carbon;

class Company
{
    /**
     * @var string|null
     */
    public ?string $name;

    /**
     * @var string|null
     */
    public ?string $etag;

    /**
     * @var Address
     */
    public Address $address;

    /**
     * @var Account|null
     */
    public ?Account $accounts;

    /**
     * @var bool|null
     */
    public ?bool $insolvent;

    /**
     * @var string|null
     */
    public ?string $jurisdiction;

    /**
     * @var string|null
     */
    public ?string $status;

    /**
     * @var Carbon|null
     */
    public ?Carbon $created;

    /**
     * @var array|null
     */
    public ?array $sicCodes;

    /**
     * @var string|null
     */
    public ?string $number;

    /**
     * @var string|null
     */
    public ?string $type;

    /**
     * @var Statement|null
     */
    public ?Statement $confirmationStatement;

    /**
     * @var bool|null
     */
    public ?bool $hasCharges;

    /**
     * @var bool|null
     */
    public ?bool $canFile;

    /**
     * Company constructor.
     * @param array $data
     */
    private function __construct(array $data)
    {
        $this->name = isset($data['company_name']) ? $data['company_name'] : null;
        $this->etag = isset($data['etag']) ? $data['etag'] : null;
        $this->address = Address::make($data);
        $this->accounts = Account::make($data);
        $this->insolvent = isset($data['has_insolvency_history']) ? $data['has_insolvency_history'] : null;
        $this->jurisdiction = isset($data['jurisdiction']) ? $data['jurisdiction'] : null;
        $this->status = isset($data['company_status']) ? $data['company_status'] : null;
        $this->created = isset($data['date_of_creation'])
            ? Carbon::parse($data['date_of_creation'])
            : null;
        $this->sicCodes = isset($data['sic_codes']) ? $data['sic_codes'] : null;
        $this->number = isset($data['company_number']) ? $data['company_number'] : null;
        $this->type = isset($data['type']) ? $data['type'] : null;
        $this->confirmationStatement = Statement::make($data);
        $this->hasCharges = isset($data['has_charges']) ? $data['has_charges'] ; null;
        $this->canFile = isset($data['can_file']) ? $data['can_file'] : null;
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
