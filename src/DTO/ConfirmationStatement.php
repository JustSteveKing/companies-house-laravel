<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class ConfirmationStatement extends DataTransferObject
{
    public null|bool $overdue;
    public Carbon $nextDue;
    public Carbon $lastMadeUpTo;
    public Carbon $nextMadeUpTo;

    public static function hydrate(array $item): self
    {
        return new self(
            overdue: $item['overdue'],
            nextDue: Carbon::parse($item['next_due']),
            lastMadeUpTo: Carbon::parse($item['last_made_up_to']),
            nextMadeUpTo: Carbon::parse($item['next_made_up_to']),
        );
    }
}
