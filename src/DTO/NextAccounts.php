<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class NextAccounts extends DataTransferObject
{
    public null|bool $overdue;
    public Carbon $dueOn;
    public Carbon $periodEndOn;
    public Carbon $periodStartOn;

    public static function hydrate(array $item): self
    {
        return new self(
            overdue: $item['overdue'],
            dueOn: Carbon::parse($item['due_on']),
            periodEndOn: Carbon::parse($item['period_end_on']),
            periodStartOn: Carbon::parse($item['period_start_on']),
        );
    }
}
