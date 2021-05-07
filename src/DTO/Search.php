<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use JustSteveKing\CompaniesHouse\Collections\SearchCollection;

class Search extends DataTransferObject
{
    public null|string $kind;
    public null|int $totalResults;
    public SearchCollection $results;
}
