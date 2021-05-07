<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class Company extends DataTransferObject
{
    /**
     * @var null|string
     */
    public null|string $etag;

    /**
     * @var null|string
     */
    public null|string $name;

    /**
     * @var null|string
     */
    public null|string $number;

    /**
     * @var null|string
     */
    public null|string $type;

    /**
     * @var null|bool
     */
    public null|bool $charges;

    /**
     * @var null|bool
     */
    public null|bool $undeliverable;

    /**
     * @var null|bool
     */
    public null|bool $canFile;

    /**
     * @var null|bool
     */
    public null|bool $insolvencyHistory;

    /**
     * @var null|string
     */
    public null|string $jurisdiction;

    /**
     * @var null|string
     */
    public null|string $status;

    /**
     * @var null|Carbon
     */
    public null|Carbon $createdAt;

    /**
     * @var null|array
     */
    public null|array $sicCodes;

    /**
     * @var null|bool
     */
    public null|bool $officeInDispute;

    /**
     * @var null|Address
     */
    public null|Address $address;

    /**
     * @var null|ConfirmationStatement
     */
    public null|ConfirmationStatement $confirmationStatement;

    /**
     * @var null|Accounts
     */
    public null|Accounts $accounts;

    /**
     * Hydrate Company
     *
     * @param array $item
     *
     * @return self
     */
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
            createdAt: isset($item['date_of_creation'])
                ? Carbon::parse($item['date_of_creation'])
                : null,
            sicCodes: $item['sic_codes'] ?? null,
            officeInDispute: $item['registered_office_is_in_dispute'] ?? null,
            address: isset($item['registered_office_address'])
                ? Address::hydrate($item['registered_office_address'])
                : null,
            confirmationStatement: isset($item['confirmation_statement'])
                ? ConfirmationStatement::hydrate(
                    item: $item['confirmation_statement'],
                )
                : null,
            accounts: isset($item['accounts'])
                ? Accounts::hydrate(
                    item: $item['accounts']
                )
                : null,
        );
    }
}
