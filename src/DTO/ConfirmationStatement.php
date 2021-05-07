<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class ConfirmationStatement extends DataTransferObject
{
    /**
     * @var null|bool
     */
    public null|bool $overdue;

    /**
     * @var null|Carbon
     */
    public null|Carbon $nextDue;

    /**
     * @var null|Carbon
     */
    public null|Carbon $lastMadeUpTo;

    /**
     * @var null|Carbon
     */
    public null|Carbon $nextMadeUpTo;

    /**
     * Hydrate ConfirmationStatement
     *
     * @param array $item
     *
     * @return self
     */
    public static function hydrate(array $item): self
    {
        return new self(
            overdue: $item['overdue'] ?? null,
            nextDue: isset($item['next_due'])
                ? Carbon::parse($item['next_due'])
                : null,
            lastMadeUpTo: isset($item['last_made_up_to'])
                ? Carbon::parse($item['last_made_up_to'])
                : null,
            nextMadeUpTo: isset($item['next_made_up_to'])
                ? Carbon::parse($item['next_made_up_to'])
                : null,
        );
    }
}
