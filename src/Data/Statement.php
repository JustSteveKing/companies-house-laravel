<?php

namespace JustSteveKing\CompaniesHouseLaravel\Data;

use Carbon\Carbon;

class Statement
{
    /**
     * @var Carbon|null
     */
    public ?Carbon $nextDue;

    /**
     * @var Carbon|null
     */
    public ?Carbon $nextMadeUpTo;

    /**
     * @var Carbon|null
     */
    public ?Carbon $lastMadeUpTo;

    /**
     * @var bool|mixed|null
     */
    public ?bool $overdue;

    /**
     * Statement constructor.
     * @param array $data
     */
    private function __construct(array $data)
    {
        $this->nextDue = Carbon::parse($data['confirmation_statement']['next_due'] ?? null);
        $this->nextMadeUpTo = Carbon::parse($data['confirmation_statement']['next_made_up_to'] ?? null);
        $this->lastMadeUpTo = Carbon::parse($data['confirmation_statement']['last_made_up_to'] ?? null);
        $this->overdue = $data['confirmation_statement']['overdue'] ?? null;
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
