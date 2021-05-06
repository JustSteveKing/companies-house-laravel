<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse;

use RuntimeException;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\PendingRequest;
use JustSteveKing\CompaniesHouse\Concerns\HasFake;

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

        return $response;
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

        return $response;
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

        return $response;
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

        return $response;
    }

    public function registers(
        string $companyNumber,
    ) {
        $request = $this->buildRequest();

        $response = $request->get(
            url: "{$this->url}/company/{$companyNumber}/registers",
        );

        if (! $response->successful()) {
            return $response->toException();
        }

        return $response;
    }

    public function charges(
        string $companyNumber,
    ) {
        $request = $this->buildRequest();

        $response = $request->get(
            url: "{$this->url}/company/{$companyNumber}/charges",
        );

        if (! $response->successful()) {
            return $response->toException();
        }

        return $response;
    }

    public function charge(
        string $companyNumber,
        string $chargeId,
    ) {
        $request = $this->buildRequest();

        $response = $request->get(
            url: "{$this->url}/company/{$companyNumber}/charges/{$chargeId}",
        );

        if (! $response->successful()) {
            return $response->toException();
        }

        return $response;
    }

    public function filingHistory(
        string $companyNumber,
    ) {
        $request = $this->buildRequest();

        $response = $request->get(
            url: "{$this->url}/company/{$companyNumber}/filing-history",
        );

        if (! $response->successful()) {
            return $response->toException();
        }

        return $response;
    }

    public function filingHistoryTransaction(
        string $companyNumber,
        string $transactionId,
    ) {
        $request = $this->buildRequest();

        $response = $request->get(
            url: "{$this->url}/company/{$companyNumber}/filing-history/{$transactionId}",
        );

        if (! $response->successful()) {
            return $response->toException();
        }

        return $response;
    }

    public function insolvency(
        string $companyNumber,
    ) {
        $request = $this->buildRequest();

        $response = $request->get(
            url: "{$this->url}/company/{$companyNumber}/insolvency",
        );

        if (! $response->successful()) {
            return $response->toException();
        }

        return $response;
    }

    public function exemptions(
        string $companyNumber,
    ) {
        $request = $this->buildRequest();

        $response = $request->get(
            url: "{$this->url}/company/{$companyNumber}/exemptions",
        );

        if (! $response->successful()) {
            return $response->toException();
        }

        return $response;
    }

    public function disqualifications(
        string $officerId,
        null|string $prefix = null,
    ) {
        if (is_null($prefix) || ! in_array($prefix, ['corporate', 'natural'])) {
            throw new RuntimeException(
                "To check disqualified officers either pass 'corporate' or 'natural' under 'prefix'; {$prefix} passed"
            );
        }

        $request = $this->buildRequest();

        $uri = "{$this->url}/disqualified-officers/{$prefix}/{$officerId}";

        $response = $request->get(
            url: $uri,
        );

        if (! $response->successful()) {
            return $response->toException();
        }

        return $response;
    }

    public function establishments(
        string $companyNumber,
    ) {
        $request = $this->buildRequest();

        $response = $request->get(
            url: "{$this->url}/company/{$companyNumber}/uk-establishments",
        );

        if (! $response->successful()) {
            return $response->toException();
        }

        return $response;
    }
}
