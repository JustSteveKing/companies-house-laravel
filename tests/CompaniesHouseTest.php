<?php

namespace JustSteveKing\CompaniesHouseLaravel\Tests;

use JustSteveKing\CompaniesHouseLaravel\Client;
use JustSteveKing\CompaniesHouseLaravel\Rules\CompanyNumber;

class CompaniesHouseTest extends TestCase
{
    private Client $api;

    private CompanyNumber $rule;

    public function setUp(): void
    {
        parent::setUp();

        $this->api = Client::make();
        $this->rule = new CompanyNumber($this->api);
    }

    /**
     * @test
     */
    public function can_fetch_company_profile_from_number()
    {
        $number = '02627406';
        $company = $this->api->company($number);

        $this->assertEquals(
            $number,
            $company->number
        );

        $this->assertNotNull($company->name);
    }

    /**
     * @test
     */
    public function does_not_fetch_company_profile_from_invalid_number()
    {
        $number = 'obviously_fake';
        $company = $this->api->company($number);

        $this->assertNull($company);
    }

    /**
     * @test
     */
    public function it_fails_when_incorrect_company_number_is_passed()
    {
        $number = 'obviously_fake';
        $this->assertFalse($this->rule->passes('test', $number));
        $this->rule->passes('test', $number);
        $this->assertEquals(
            'The submitted company number is not a valid UK company number.',
            $this->rule->message()
        );
    }

    /**
     * @test
     */
    public function it_passes_when_correct_company_number_is_passed()
    {
        $number = '02627406';
        $this->assertTrue($this->rule->passes('test', $number));
    }
}
