<?php

namespace JustSteveKing\CompaniesHouse\Rules;

use JustSteveKing\CompaniesHouse\Client;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Http\Client\RequestException;
use Throwable;

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
        $response = $this->client->company(
            companyNumber: $value,
        );

        return ! ($response instanceof RequestException);
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return 'The submitted company number is not a valid UK company number.';
    }
}
