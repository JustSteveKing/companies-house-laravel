<?php

namespace JustSteveKing\CompaniesHouseLaravel;

use Illuminate\Support\Facades\Http;
use JustSteveKing\CompaniesHouseLaravel\Data\Company;

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
}
