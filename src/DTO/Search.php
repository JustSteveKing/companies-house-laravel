<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use JustSteveKing\CompaniesHouse\Collections\SearchCollection;

class Search extends DataTransferObject
{
    public string $kind;
    public int $itemsPerPage;
    public int $totalResults;
    public SearchCollection $results;
}
