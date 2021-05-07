<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class SearchResultOfficer extends DataTransferObject
{
    /**
     * @var null|string
     */
    public null|string $title;

    /**
     * @var null|string
     */
    public null|string $kind;

    /**
     * @var null|string
     */
    public null|string $snippet;

    /**
     * @var null|string
     */
    public null|string $description;

    /**
     * @var null|string
     */
    public null|string $descriptionIdentifiers;

    /**
     * @var null|string
     */
    public null|string $addressSnippet;

    /**
     * @var null|string
     */
    public null|string $link;

    /**
     * @var null|int
     */
    public null|int $appointmentCount;

    /**
     * @var null|Address
     */
    public null|Address $address;

    /**
     * Hydrate SearchResultOfficer
     *
     * @param array $item
     *
     * @return self
     */
    public static function hydrate(array $item): self
    {
        return new self(
            title: $item['title'] ?? null,
            kind: $item['kind'] ?? null,
            snippet: isset($item['snippet']) ? trim($item['snippet']) : null,
            description: $item['description'] ?? null,
            descriptionIdentifiers: implode(', ', $item['description_identifiers']),
            addressSnippet: $item['address_snippet'] ?? null,
            link: $item['links']['self'] ?? null,
            appointmentCount: $item['appointment_count'] ?? null,
            address: isset($item['address']) ? Address::hydrate(
                item: $item['address'],
            ) : null,
        );
    }
}
