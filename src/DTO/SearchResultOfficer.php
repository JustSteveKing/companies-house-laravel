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
}
