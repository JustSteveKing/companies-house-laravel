<?php

namespace JustSteveKing\CompaniesHouseLaravel\Rules;

use Illuminate\Contracts\Validation\Rule;
use JustSteveKing\CompaniesHouseLaravel\Client;

class CompanyNumber implements Rule
{
    /**
     * @var Client
     */
    private Client $api;

    /**
     * CompanyNumber constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->api = $client;
    }

    /**
     * @param string $attributes
     * @param mixed $value
     * @return bool
     */
    public function passes($attributes, $value): bool
    {
        return ! is_null($this->api->company($value));
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return 'The submitted company number is not a valid UK company number.';
    }
}
