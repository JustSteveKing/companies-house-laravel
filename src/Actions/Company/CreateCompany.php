<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\Actions\Company;

use Illuminate\Http\Client\Response;
use JustSteveKing\CompaniesHouse\DTO\Company;

class CreateCompany
{
    /**
     * Handle the creation of a Company
     *
     * @param Response $response
     *
     * @return Company
     */
    public function handle(Response $response): Company
    {
        if (is_null($response->json())) {
            return new Company();
        }

        return Company::hydrate(
            item: $response->json(),
        );
    }
}
