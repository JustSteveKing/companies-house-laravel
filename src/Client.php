<?php

namespace JustSteveKing\CompaniesHouseLaravel;

use Illuminate\Support\Facades\Http;
use JustSteveKing\CompaniesHouseLaravel\Collections\CompanyCollection;
use JustSteveKing\CompaniesHouseLaravel\Data\Company;
use JustSteveKing\CompaniesHouseLaravel\Data\Company\SearchResult;

class Client
{
    /**
     * @var string
     */
    private string $key;

    /**
     * CompaniesHouseLaravel constructor.
     */
    private function __construct()
    {
        $this->key = config('companies-house-laravel.api.key');
    }

    /**
     * @return self
     */
    public static function make(): self
    {
        return new self();
    }

    /**
     * @param string $number
     * @return Company|null
     */
    public function company(string $number):? Company
    {
        $response = Http::withBasicAuth(
            $this->key,
            ''
        )
            ->get(config('companies-house-laravel.api.url') . '/company/' . $number);

        if ($response->ok()) {
            return Company::fromApi($response->json());
        }

        return null;
    }

    public function searchCompany(string $query, ?int $perPage = null, ?int $startIndex = null): CompanyCollection
    {
        $response = Http::withBasicAuth(
            $this->key,
            ''
        )->get(
            config('companies-house-laravel.api.url') . '/search/companies',
            [
                'q' => $query,
                'items_per_page' => $perPage,
                'start_index' => $startIndex
            ]
        );

        $collection = new CompanyCollection();
        foreach ($response->json('items') as $item) {

            $collection->add(
                SearchResult::fromApi($item)
            );
        }

        return $collection;
    }
}
