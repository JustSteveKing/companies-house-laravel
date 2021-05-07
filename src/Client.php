<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse;

use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use JustSteveKing\CompaniesHouse\DTO\Search;
use JustSteveKing\CompaniesHouse\DTO\Officer;
use JustSteveKing\CompaniesHouse\Concerns\HasFake;
use JustSteveKing\CompaniesHouse\Collections\SearchCollection;
use JustSteveKing\CompaniesHouse\Actions\Company\CreateCompany;
use JustSteveKing\CompaniesHouse\Actions\Officer\CreateOfficer;
use JustSteveKing\CompaniesHouse\Collections\OfficersCollection;
use JustSteveKing\CompaniesHouse\Actions\Search\CreateSearchResults;
use JustSteveKing\CompaniesHouse\DTO\Company;

class Client
{
    use HasFake;
    
    /**
     * Client constructor.
     *
     * @return void
     */
    public function __construct(
        protected string $url,
        protected string $apiKey,
        protected int|string $timeout = 10,
        protected null|string|int $retryTimes = null,
        protected null|string|int $retryMilliseconds = null,
    ) {
    }

    /**
     * Make a new Client
     *
     * @return Client
     */
    public static function make(
        string $url,
        string $apiKey,
        int $timeout = 10,
        null|int $retryTimes = null,
        null|int $retryMilliseconds = null,
    ): Client {
        return new Client(
            url: $url,
            apiKey: $apiKey,
            timeout: $timeout,
            retryTimes: $retryTimes,
            retryMilliseconds: $retryMilliseconds,
        );
    }

    /**
     * Build our default Request
     *
     * @return PendingRequest
     */
    public function buildRequest(): PendingRequest
    {
        $request = Http::withBasicAuth(
            username: $this->apiKey,
            password: '',
        )->withHeaders([
            'Accept' => 'application/json'
        ])->timeout(
            seconds: (int) $this->timeout,
        );

        if (
            ! is_null($this->retryTimes)
            && ! is_null($this->retryMilliseconds)
        ) {
            $request->retry(
                times: (int) $this->retryTimes,
                sleep: (int) $this->retryMilliseconds,
            );
        }

        return $request;
    }

    /**
     * Search everything
     *
     * @param string $query
     * @param string $prefix
     * @param null|int $perPage
     * @param null|int $startIndex
     *
     * @throws Illuminate\Http\Client\RequestException
     *
     * @return Search
     */
    public function search(
        string $query,
        string $prefix = '',
        null|int $perPage = null,
        null|int $startIndex = null,
    ): Search {
        $request = $this->buildRequest();

        $response = $request->get(
            url: "{$this->url}/search{$prefix}",
            query: [
                'q' => $query,
                'items_per_page' => $perPage,
                'start_index' => $startIndex,
            ],
        );

        if (! $response->successful()) {
            return $response->toException();
        }

        $searchCollection = (new CreateSearchResults())->handle(
            response: $response,
        );

        return $searchCollection;
    }

    /**
     * Search companies
     *
     * @param string $query
     * @param null|int $perPage
     * @param null|int $startIndex
     *
     * @throws Illuminate\Http\Client\RequestException
     *
     * @return Search
     */
    public function searchCompany(
        string $query,
        ?int $perPage = null,
        ?int $startIndex = null,
    ): Search {
        return $this->search(
            query: $query,
            prefix: 'companies',
            perPage: $perPage,
            startIndex: $startIndex,
        );
    }

    /**
     * Search Officers
     *
     * @param string $query
     * @param null|int $perPage
     * @param null|int $startIndex
     *
     * @throws Illuminate\Http\Client\RequestException
     *
     * @return Search
     */
    public function searchOfficers(
        string $query,
        ?int $perPage = null,
        ?int $startIndex = null,
    ): Search {
        return $this->search(
            query: $query,
            prefix: 'officers',
            perPage: $perPage,
            startIndex: $startIndex,
        );
    }

    /**
     * Search Disqualified Officers
     *
     * @param string $query
     * @param null|int $perPage
     * @param null|int $startIndex
     *
     * @throws Illuminate\Http\Client\RequestException
     *
     * @return Search
     */
    public function searchDisqualifiedOfficers(
        string $query,
        ?int $perPage = null,
        ?int $startIndex = null,
    ): Search {
        return $this->search(
            query: $query,
            prefix: 'disqualified-officers',
            perPage: $perPage,
            startIndex: $startIndex,
        );
    }

    /**
     * Lookup a Company by their company number
     *
     * @param string $companyNumber
     *
     * @throws Illuminate\Http\Client\RequestException
     *
     * @return Company
     */
    public function company(
        string $companyNumber,
    ): Company {
        $request = $this->buildRequest();

        $response = $request->get(
            url: "{$this->url}/company/{$companyNumber}"
        );

        if (! $response->successful()) {
            return $response->toException();
        }

        $company = (new CreateCompany())->handle(
            response: $response,
        );

        return $company;
    }

    /**
     * Retrieve all Company Officer as a Collection
     *
     * @param string $companyNumber
     * @param null|int $perPage
     * @param null|int $startIndex
     *
     * @throws Illuminate\Http\Client\RequestException
     *
     * @return OfficersCollection
     */
    public function officers(
        string $companyNumber,
        null|int $perPage = null,
        null|int $startIndex = null,
    ): OfficersCollection {
        $request = $this->buildRequest();

        $response = $request->get(
            url: "{$this->url}/company/{$companyNumber}/officers",
            query: [
                'items_per_page' => $perPage,
                'start_index' => $startIndex,
            ],
        );

        if (! $response->successful()) {
            return $response->toException();
        }
        
        $data = $response->json();

        $officerColection = new OfficersCollection();

        if (is_null($data)) {
            return $officerColection;
        }

        foreach ($data['items'] as $item) {
            $officer = (new CreateOfficer())->handle(
                item: $item,
            );
            
            $officerColection->add(
                item: $officer,
            );
        }

        return $officerColection;
    }

    /**
     * Get a Company Officer by their appointment ID
     *
     * @param string $companyNumber
     * @param string $appointmentId
     *
     * @throws Illuminate\Http\Client\RequestException
     *
     * @return Officer
     */
    public function officer(
        string $companyNumber,
        string $appointmentId
    ): Officer {
        $request = $this->buildRequest();

        $response = $request->get(
            url: "{$this->url}/company/{$companyNumber}/appointments/{$appointmentId}"
        );

        if (! $response->successful()) {
            return $response->toException();
        }

        if (is_null($response->json())) {
            return new Officer();
        }

        $officer = (new CreateOfficer())->handle(
            item: $response->json(),
        );

        return $officer;
    }
}
