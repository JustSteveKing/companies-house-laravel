<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\DTO;

use Spatie\DataTransferObject\DataTransferObject;
use JustSteveKing\CompaniesHouse\Collections\SearchCollection;

class Search extends DataTransferObject
{
    /**
     * @var null|string
     */
    public null|string $kind;

    /**
     * @var null|int
     */
    public null|int $totalResults;

    /**
     * @var SearchCollection
     */
    public SearchCollection $results;
}
