<?php

namespace JustSteveKing\CompaniesHouseLaravel\Data;

use Carbon\Carbon;

class Account
{
    /**
     * @var string|null
     */
    public ?string $lastAccounts;

    /**
     * @var Carbon|null
     */
    public ?Carbon $nextDue;

    /**
     * @var NextAccount
     */
    public NextAccount $nextAccounts;

    /**
     * @var ReferenceDate
     */
    public ReferenceDate $referenceDate;

    /**
     * @var Carbon|null
     */
    public ?Carbon $madeUpTo;

    /**
     * @var bool|mixed|null
     */
    public ?bool $overdue;

    private function __construct(array $data)
    {
        $this->lastAccounts = $data['accounts']['last_accounts']['type'] ?? null;
        $this->nextDue = Carbon::parse($data['accounts']['next_due'] ?? null);
        $this->nextAccounts = NextAccount::make($data);
        $this->referenceDate = ReferenceDate::make($data);
        $this->madeUpTo = Carbon::parse($data['accounts']['next_made_up_to'] ?? null);
        $this->overdue = $data['accounts']['overdue'] ?? null;
    }

    public static function make(array $data): self
    {
        return new self($data);
    }
}
