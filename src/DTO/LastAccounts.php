<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class LastAccounts extends DataTransferObject
{
    /**
     * @var null|Carbon
     */
    public null|Carbon $periodStartOn;

    /**
     * @var null|Carbon
     */
    public null|Carbon $periodEndOn;

    /**
     * @var null|string
     */
    public null|string $type;

    /**
     * @var null|Carbon
     */
    public null|Carbon $madeUpTo;

    /**
     * Hydrate LastAccounts
     *
     * @param array $item
     *
     * @return self
     */
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
