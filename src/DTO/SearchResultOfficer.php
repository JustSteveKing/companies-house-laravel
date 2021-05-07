<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class SearchResultOfficer extends DataTransferObject
{
    public string $title;
    public string $kind;
    public null|string $snippet;
    public string $description;
    public string $descriptionIdentifiers;
    public string $addressSnippet;
    public string $link;
    public null|int $appointmentCount;
    public Address $address;

    public static function hydrate(array $item): self
    {
        return new self(
            title: $item['title'],
            kind: $item['kind'],
            snippet: trim($item['snippet']),
            description: $item['description'],
            descriptionIdentifiers: implode(', ', $item['description_identifiers']),
            addressSnippet: $item['address_snippet'],
            link: $item['links']['self'],
            appointmentCount: $item['appointment_count'],
            address: Address::hydrate(
                item: $item['address'],
            ),
        );
    }
}
