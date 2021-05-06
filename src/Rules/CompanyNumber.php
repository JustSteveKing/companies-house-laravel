<?php

namespace JustSteveKing\CompaniesHouse\Rules;

use JustSteveKing\CompaniesHouse\Client;
use Illuminate\Contracts\Validation\Rule;

class CompanyNumber implements Rule
{
    /**
     * CompanyNumber constructor.
     * @param Client $client
     */
    public function __construct(
        private Client $client,
    ) {}

    /**
     * @param string $attributes
     * @param mixed $value
     * @return bool
     */
    public function passes($attributes, $value): bool
    {
        return ! is_null($this->client->company(
            companyNumber: $value,
        ));
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return 'The submitted company number is not a valid UK company number.';
    }
}
