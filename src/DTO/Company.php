<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class Company extends DataTransferObject
{
    public null|string $etag;
    public null|string $name;
    public null|string $number;
    public null|string $type;
    public null|bool $charges;
    public null|bool $undeliverable;
    public null|bool $canFile;
    public null|bool $insolvencyHistory;
    public null|string $jurisdiction;
    public null|string $status;
    public null|Carbon $createdAt;
    public null|array $sicCodes;
    public null|bool $officeInDispute;
    public null|Address $address;
    public null|ConfirmationStatement $confirmationStatement;
    public null|Accounts $accounts;

    public static function hydrate(array $item): self
    {
        return new self(
            etag: $item['etag'] ?? null,
            name: $item['company_name'] ?? null,
            number: $item['company_number'] ?? null,
            type: $item['type'] ?? null,
            charges: $item['has_charges'] ?? null,
            undeliverable: $item['undeliverable_registered_office_address'] ?? null,
            canFile: $item['can_file'] ?? null,
            insolvencyHistory: $item['has_insolvency_history'] ?? null,
            jurisdiction: $item['jurisdiction'] ?? null,
            status: $item['company_status'] ?? null,
            createdAt: Carbon::parse($item['date_of_creation']),
            sicCodes: $item['sic_codes'] ?? null,
            officeInDispute: $item['registered_office_is_in_dispute'] ?? null,
            address: Address::hydrate($item['registered_office_address']),
            confirmationStatement: ConfirmationStatement::hydrate(
                item: $item['confirmation_statement'],
            ),
            accounts: Accounts::hydrate(
                item: $item['accounts']
            ),
        );
    }
}
