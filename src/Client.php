<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse;

use RuntimeException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use JustSteveKing\CompaniesHouse\DTO\Officer;
use JustSteveKing\CompaniesHouse\Concerns\HasFake;
use JustSteveKing\CompaniesHouse\Actions\Company\CreateCompany;
use JustSteveKing\CompaniesHouse\Actions\Officer\CreateOfficer;
use JustSteveKing\CompaniesHouse\Collections\OfficersCollection;
use JustSteveKing\CompaniesHouse\Actions\Search\CreateSearchResults;

class Client
{
    use HasFake;
    
    /**
     * Client constructor.
     */
    public function __construct(
        protected string $url,
        protected string $apiKey,
        protected int|string $timeout = 10,
        protected null|string|int $retryTimes = null,
        protected null|string|int $retryMilliseconds = null,
    ) {}

    /**
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

    public function search(
        string $query,
        string $prefix = '',
        ?int $perPage = null,
        ?int $startIndex = null,
    ) {
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

    public function searchCompany(
        string $query,
        ?int $perPage = null,
        ?int $startIndex = null,
    ) {
        return $this->search(
            query: $query,
            prefix: 'companies',
            perPage: $perPage,
            startIndex: $startIndex,
        );
    }

    public function searchOfficers(
        string $query,
        ?int $perPage = null,
        ?int $startIndex = null,
    ) {
        return $this->search(
            query: $query,
            prefix: 'officers',
            perPage: $perPage,
            startIndex: $startIndex,
        );
    }

    public function searchDisqualifiedOfficers(
        string $query,
        ?int $perPage = null,
        ?int $startIndex = null,
    ) {
        return $this->search(
            query: $query,
            prefix: 'disqualified-officers',
            perPage: $perPage,
            startIndex: $startIndex,
        );
    }

    public function company(
        string $companyNumber,
    ) {
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

    public function officers(
        string $companyNumber,
        ?int $perPage = null,
        ?int $startIndex = null,
    ){
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

    public function officer(
        string $companyNumber,
        string $appointmentId
    ) {
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
