<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\Actions\Search;

use Illuminate\Http\Client\Response;
use JustSteveKing\CompaniesHouse\DTO\Search;
use JustSteveKing\CompaniesHouse\DTO\SearchResultCompany;
use JustSteveKing\CompaniesHouse\DTO\SearchResultOfficer;
use JustSteveKing\CompaniesHouse\Collections\SearchCollection;

class CreateSearchResults
{
    /**
     * Handle the creation of Search Results
     *
     * @param Response $response
     *
     * @return Search
     */
    public function handle(Response $response): Search
    {
        $data = $response->json();

        $search = new Search(
            kind: $data['kind'] ?? null,
            totalResults: $data['total_results'] ?? null,
            results: new SearchCollection(),
        );

        if (! is_null($data)) {
            foreach ($data['items'] as $item) {
                if ($item['kind'] === 'searchresults#company') {
                    $result = SearchResultCompany::hydrate(
                        item: $item,
                    );
    
                    $search->results->add(
                        item: $result,
                    );
                }
                
                if (
                    $item['kind'] === 'searchresults#officer' ||
                    $item['kind'] === 'searchresults#disqualified-officer'
                ) {
                    $result = SearchResultOfficer::hydrate(
                        item: $item,
                    );
    
                    $search->results->add(
                        item: $result,
                    );
                }
            }
        }

        return $search;
    }
}
