<?php

declare(strict_types=1);

namespace JustSteveKing\CompaniesHouse\Tests;

use RuntimeException;
use JustSteveKing\CompaniesHouse\Client;
use Illuminate\Http\Client\PendingRequest;

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

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
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

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
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

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
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

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
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

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
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

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
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
            appointmentId: '123',
        );

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
        );
    }

    /**
     * @test
     */
    public function it_can_get_all_company_registers()
    {
        $this->client->fake();

        $response = $this->client->registers(
            companyNumber: 'test'
        );

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
        );
    }

    /**
     * @test
     */
    public function it_can_get_all_company_charges()
    {
        $this->client->fake();

        $response = $this->client->charges(
            companyNumber: 'test'
        );

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
        );
    }

    /**
     * @test
     */
    public function it_can_get_a_specific_company_charge()
    {
        $this->client->fake();

        $response = $this->client->charge(
            companyNumber: 'test',
            chargeId: '123',
        );

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
        );
    }

    /**
     * @test
     */
    public function it_can_get_a_companies_filing_history()
    {
        $this->client->fake();

        $response = $this->client->filingHistory(
            companyNumber: 'test',
        );

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
        );
    }

    /**
     * @test
     */
    public function it_can_get_a_specific_filing_history_transaction()
    {
        $this->client->fake();

        $response = $this->client->filingHistoryTransaction(
            companyNumber: 'test',
            transactionId: '123',
        );

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
        );
    }

    /**
     * @test
     */
    public function it_can_get_a_companies_insolvency_information()
    {
        $this->client->fake();

        $response = $this->client->insolvency(
            companyNumber: 'test',
        );

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
        );
    }

    /**
     * @test
     */
    public function it_can_get_a_companies_exemption_information()
    {
        $this->client->fake();

        $response = $this->client->exemptions(
            companyNumber: 'test',
        );

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
        );
    }

    /**
     * @test
     */
    public function it_can_get_an_officers_disqualifications()
    {
        $this->client->fake();

        $response = $this->client->disqualifications(
            officerId: 'test',
            prefix: 'corporate',
        );

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
        );

        $response = $this->client->disqualifications(
            officerId: 'test',
            prefix: 'natural',
        );

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
        );

        $this->expectException(
            exception: RuntimeException::class,
        );

        $this->expectExceptionMessage(
            message: "To check disqualified officers either pass 'corporate' or 'natural' under 'prefix'; test passed"
        );

        $response = $this->client->disqualifications(
            officerId: 'test',
            prefix: 'test',
        );
    }

    /**
     * @test
     */
    public function it_can_get_a_companies_establishments()
    {
        $this->client->fake();

        $response = $this->client->establishments(
            companyNumber: 'test',
        );

        $this->assertEquals(
            expected: 200,
            actual: $response->getStatusCode(),
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
}
