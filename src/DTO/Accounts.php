<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class Accounts extends DataTransferObject
{
    public null|bool $overdue;
    public Carbon $nextMadeUpTo;
    public Carbon $nextDue;
    public NextAccounts $nextAccounts;
    public LastAccounts $lastAccounts;
    public AccountingReference $accountingReferenceDate;

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
