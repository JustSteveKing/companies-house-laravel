<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\Rules;

use Throwable;
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
    ) {
    }

    /**
     * @param string $attributes
     * @param mixed $value
     * @return bool
     */
    public function passes($attributes, $value): bool
    {
        try {
            $response = $this->client->company(
                companyNumber: $value,
            );
        } catch (Throwable) {
            return false;
        }

        return true;
    }

    /**
     * @return string
     */
    public function message(): string
    {
        return 'The submitted company number is not a valid UK company number.';
    }
}
