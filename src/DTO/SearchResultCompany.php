<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class SearchResultCompany extends DataTransferObject
{
    /**
     * @var null|string
     */
    public null|string $type;

    /**
     * @var null|Carbon
     */
    public null|Carbon $dateOfCreation;

    /**
     * @var null|string
     */
    public null|string $title;

    /**
     * @var null|string
     */
    public null|string $status;

    /**
     * @var null|string
     */
    public null|string $kind;

    /**
     * @var null|string
     */
    public null|string $addressSnippet;

    /**
     * @var null|string
     */
    public null|string $link;

    /**
     * @var null|string
     */
    public null|string $companyNumber;

    /**
     * @var null|string
     */
    public null|string $description;

    /**
     * @var null|string
     */
    public null|string $descriptionIdentifiers;

    /**
     * @var null|Address
     */
    public null|Address $address;

    /**
     * Hydrate SearchResultCompany
     *
     * @param array $item
     *
     * @return self
     */
    public static function hydrate(array $item): self
    {
        return new self(
            type: $item['company_type'] ?? null,
            dateOfCreation: Carbon::parse($item['date_of_creation']),
            title: $item['title'] ?? null,
            status: $item['company_status'] ?? null,
            kind: $item['kind'] ?? null,
            addressSnippet: $item['address_snippet'] ?? null,
            link: $item['links']['self'] ?? null,
            companyNumber: $item['company_number'] ?? null,
            description: $item['description'] ?? null,
            descriptionIdentifiers: $item['description_identifier'][0],
            address: Address::hydrate(
                item: $item['address'],
            ),
        );
    }
}
