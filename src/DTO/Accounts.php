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
            overdue: $item['overdue'],
            nextDue: Carbon::parse($item['next_due']),
            nextMadeUpTo: Carbon::parse($item['next_made_up_to']),
            nextAccounts: NextAccounts::hydrate(
                item: $item['next_accounts'],
            ),
            lastAccounts: LastAccounts::hydrate(
                item: $item['last_accounts'],
            ),
            accountingReferenceDate: AccountingReference::hydrate(
                item: $item['accounting_reference_date'],
            ),
        );
    }
}
