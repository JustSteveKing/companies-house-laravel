<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class Accounts extends DataTransferObject
{
    /**
     * @var null|bool
     */
    public null|bool $overdue;

    /**
     * @var null|Carbon
     */
    public null|Carbon $nextMadeUpTo;

    /**
     * @var null|Carbon
     */
    public null|Carbon $nextDue;

    /**
     * @var null|NextAccounts
     */
    public null|NextAccounts $nextAccounts;

    /**
     * @var null|LastAccounts
     */
    public null|LastAccounts $lastAccounts;

    /**
     * @var null|AccountingReference
     */
    public null|AccountingReference $accountingReferenceDate;

    /**
     * Hydrate Accounts
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
            nextMadeUpTo: isset($item['next_made_up_to'])
                ? Carbon::parse($item['next_made_up_to'])
                : null,
            nextAccounts: isset($item['next_accounts'])
                ? NextAccounts::hydrate(
                    item: $item['next_accounts'],
                )
                : null,
            lastAccounts: isset($item['last_accounts'])
                ? LastAccounts::hydrate(
                    item: $item['last_accounts'],
                )
                : null,
            accountingReferenceDate: isset($item['accounting_reference_date'])
                ? AccountingReference::hydrate(
                    item: $item['accounting_reference_date'],
                )
                : null,
        );
    }
}
