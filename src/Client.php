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
     * @var bool
     */
    private bool $fake;

    /**
     * @var array|null
     */
    private ?array $fakeData;

    /**
     * CompaniesHouseLaravel constructor.
     */
    private function __construct(bool $fake = false, ?array $data = null)
    {
        $this->fake = $fake;
        $this->fakeData = $data;
        $this->key = config('companies-house-laravel.api.key');

        if ($this->fake) {
            Http::fake($this->fakeData);
        }
    }

    /**
     * @return self
     */
    public static function make(): self
    {
        return new self();
    }

    /**
     * @return self
     */
    public static function fake(array $data): self
    {
        return new self(true, $data);
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
                'start_index' => $startIndex,
            ]
        );

        $collection = new CompanyCollection();

        if (empty($response->json('items'))) {
            return $collection;
        }

        foreach ($response->json('items') as $item) {
            $collection->add(
                SearchResult::fromApi($item)
            );
        }

        return $collection;
    }
}
