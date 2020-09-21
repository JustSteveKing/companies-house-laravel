<?php

namespace JustSteveKing\CompaniesHouseLaravel\Data;

use Carbon\Carbon;

class NextAccount
{
    /**
     * @var Carbon|null
     */
    public ?Carbon $dueOn;

    /**
     * @var Carbon|null
     */
    public ?Carbon $periodEndOn;

    /**
     * @var bool|null
     */
    public ?bool $overdue;

    /**
     * @var Carbon|null
     */
    public ?Carbon $periodStartOn;

    /**
     * NextAccount constructor.
     * @param array $data
     */
    private function __construct(array $data)
    {
        $this->dueOn = Carbon::parse($data['accounts']['next_accounts']['due_on'] ?? null);
        $this->periodEndOn = Carbon::parse($data['accounts']['next_accounts']['period_end_on'] ?? null);
        $this->overdue = $data['accounts']['next_accounts']['overdue'] ?? null;
        $this->periodStartOn = Carbon::parse($data['accounts']['next_accounts']['period_start_on'] ?? null);
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
