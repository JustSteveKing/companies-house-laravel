<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Carbon\Carbon;
use Spatie\DataTransferObject\DataTransferObject;

class SearchResultCompany extends DataTransferObject
{
    public string $type;
    public Carbon $dateOfCreation;
    public string $title;
    public string $status;
    public string $kind;
    public string $addressSnippet;
    public string $link;
    public string $companyNumber;
    public string $description;
    public string $descriptionIdentifiers;
    public Address $address;

    public static function hydrate(array $item): self
    {
        return new self(
            type: $item['company_type'],
            dateOfCreation: Carbon::parse($item['date_of_creation']),
            title: $item['title'],
            status: $item['company_status'],
            kind: $item['kind'],
            addressSnippet: $item['address_snippet'],
            link: $item['links']['self'],
            companyNumber: $item['company_number'],
            description: $item['description'],
            descriptionIdentifiers: $item['description_identifier'][0],
            address: Address::hydrate(
                item: $item['address'],
            ),
        );
    }
}
