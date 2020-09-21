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
     * @var Account
     */
    public Account $accounts;

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
     * @var Statement
     */
    public Statement $confirmationStatement;

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
        $this->name = $data['company_name'];
        $this->etag = $data['etag'];
        $this->address = Address::make($data);
        $this->accounts = Account::make($data);
        $this->insolvent = $data['has_insolvency_history'];
        $this->jurisdiction = $data['jurisdiction'];
        $this->status = $data['company_status'];
        $this->created = Carbon::parse($data['date_of_creation'] ?? null);
        $this->sicCodes = $data['sic_codes'];
        $this->number = $data['company_number'];
        $this->type = $data['type'];
        $this->confirmationStatement = Statement::make($data);
        $this->hasCharges = $data['has_charges'];
        $this->canFile = $data['can_file'];
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
