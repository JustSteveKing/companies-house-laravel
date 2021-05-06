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
}
