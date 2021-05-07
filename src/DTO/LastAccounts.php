<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class LastAccounts extends DataTransferObject
{
    public Carbon $periodStartOn;
    public Carbon $periodEndOn;
    public null|string $type;
    public Carbon $madeUpTo;

    public static function hydrate(array $item): self
    {
        return new self(
            periodStartOn: Carbon::parse($item['period_start_on']),
            periodEndOn: Carbon::parse($item['period_end_on']),
            type: $item['type'] ?? null,
            madeUpTo: Carbon::parse($item['made_up_to']),
        );
    }
}
