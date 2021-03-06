<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class NextAccounts extends DataTransferObject
{
    /**
     * @var null|bool
     */
    public null|bool $overdue;

    /**
     * @var null|Carbon
     */
    public null|Carbon $dueOn;

    /**
     * @var null|Carbon
     */
    public null|Carbon $periodEndOn;

    /**
     * @var null|Carbon
     */
    public null|Carbon $periodStartOn;

    /**
     * Hydrate NextAccounts
     *
     * @param array $item
     *
     * @return self
     */
    public static function hydrate(array $item): self
    {
        return new self(
            overdue: $item['overdue'],
            dueOn: isset($item['due_on'])
                ? Carbon::parse($item['due_on'])
                : null,
            periodEndOn: isset($item['period_end_on'])
                ? Carbon::parse($item['period_end_on'])
                : null,
            periodStartOn: isset($item['period_start_on'])
                ? Carbon::parse($item['period_start_on'])
                : null,
        );
    }
}
