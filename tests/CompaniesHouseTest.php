<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\Tests;

use Illuminate\Validation\Rule;
use JustSteveKing\CompaniesHouse\Client;
use Illuminate\Http\Client\PendingRequest;
use JustSteveKing\CompaniesHouse\DTO\Search;
use JustSteveKing\CompaniesHouse\DTO\Company;
use JustSteveKing\CompaniesHouse\DTO\Officer;
use JustSteveKing\CompaniesHouse\Collections\OfficersCollection;

class CompaniesHouseTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->client = resolve(Client::class);
    }

    /**
     * @test
     */
    public function it_can_build_a_client_to_make_calls()
    {
        $this->assertInstanceOf(
            expected: Client::class,
            actual: $this->client,
        );
    }

    /**
     * @test
     */
    public function it_can_search_all()
    {
        $this->client->fake();

        $response = $this->client->search(
            query: 'test',
        );

        $this->assertInstanceOf(
            expected: Search::class,
            actual: $response,
        );
    }

    /**
     * @test
     */
    public function it_can_search_companies()
    {
        $this->client->fake();

        $response = $this->client->searchCompany(
            query: 'test',
        );

        $this->assertInstanceOf(
            expected: Search::class,
            actual: $response,
        );
    }

    /**
     * @test
     */
    public function it_can_search_officers()
    {
        $this->client->fake();

        $response = $this->client->searchOfficers(
            query: 'test',
        );

        $this->assertInstanceOf(
            expected: Search::class,
            actual: $response,
        );
    }

    /**
     * @test
     */
    public function it_can_search_disqualified_officers()
    {
        $this->client->fake();

        $response = $this->client->searchDisqualifiedOfficers(
            query: 'test',
        );

        $this->assertInstanceOf(
            expected: Search::class,
            actual: $response,
        );
    }

    /**
     * @test
     */
    public function it_can_get_a_company()
    {
        $this->client->fake();

        $response = $this->client->company(
            companyNumber: 'test'
        );

        $this->assertInstanceOf(
            expected: Company::class,
            actual: $response,
        );
    }

    /**
     * @test
     */
    public function it_can_get_a_companies_officers()
    {
        $this->client->fake();

        $response = $this->client->officers(
            companyNumber: 'test'
        );

        $this->assertInstanceOf(
            expected: OfficersCollection::class,
            actual: $response,
        );
    }

    /**
     * @test
     */
    public function it_can_get_a_specific_company_officer()
    {
        $this->client->fake();

        $response = $this->client->officer(
            companyNumber: 'test',
            appointmentId: 'test',
        );

        $this->assertInstanceOf(
            expected: Officer::class,
            actual: $response,
        );
    }

    /**
     * @test
     */
    public function it_can_create_a_pending_request_to_send()
    {
        $this->client->fake();

        $this->assertInstanceOf(
            expected: PendingRequest::class,
            actual: $this->client->buildRequest(),
        );
    }

    /**
     * @test
     */
    public function it_fails_when_using_the_rule_macro()
    {
        $number = 'quite_obviously_fake';

        $this->assertFalse(
            condition: Rule::companyNumber()->passes(
                attributes: 'test',
                value: $number,
            ),
        );
    }

    /**
     * @test
     */
    public function it_passes_when_using_the_rule_macro()
    {
        $number = '02627406';

        $this->assertTrue(
            condition: Rule::companyNumber()->passes(
                attributes: 'test',
                value: $number,
            ),
        );
    }
}
