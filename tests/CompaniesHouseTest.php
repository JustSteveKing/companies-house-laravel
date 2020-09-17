<?php

namespace JustSteveKing\CompaniesHouseLaravel\Tests;

use Illuminate\Support\Facades\Http;
use Illuminate\Validation\Rule;
use JustSteveKing\CompaniesHouseLaravel\Client;
use JustSteveKing\CompaniesHouseLaravel\Collections\CompanyCollection;
use JustSteveKing\CompaniesHouseLaravel\Data\Company\SearchResult;
use JustSteveKing\CompaniesHouseLaravel\Rules\CompanyNumber;

class CompaniesHouseTest extends TestCase
{
    private Client $api;

    private CompanyNumber $rule;

    public function setUp(): void
    {
        parent::setUp();

        Http::fake([
            config('companies-house-laravel.api.url') . '/company/02627406' => Http::response($this->data(), 200, ['Headers']),
            config('companies-house-laravel.api.url') . '/company/obviously_fake' => Http::response([
                'errors' => [
                    [
                        'type' => 'ch:service',
                        'error' => 'company-profile-not-found',
                    ],
                ],
            ], 404, ['Headers']),
            config('companies-house-laravel.api.url') . '/search/company/Dyson' => Http::response($this->dataSearchCompany(), 200, ['Headers']),
            config('companies-house-laravel.api.url') . '/search/company/1234567890' => Http::response([
                'items' => [],
            ], 200, ['Headers']),
        ]);

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

        if (! is_null($company->number)) {
            $this->assertEquals(
                $number,
                $company->number
            );
        }

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

    /**
     * @test
     */
    public function it_fails_when_using_the_rule_macro()
    {
        $number = 'obviously_fake';
        $this->assertFalse(Rule::companyNumber()->passes('test', $number));
    }

    /**
     * @test
     */
    public function it_passes_when_using_the_rule_macro()
    {
        $number = '02627406';
        $this->assertTrue(Rule::companyNumber()->passes('test', $number));
    }

    /**
     * @test
     */
    public function searching_for_a_company_returns_a_collection_of_company_search_results()
    {
        $collection = $this->api->searchCompany('Lila', 2);

        $this->assertInstanceOf(
            CompanyCollection::class,
            $collection
        );

        $this->assertInstanceOf(
            SearchResult::class,
            $collection->first()
        );
    }

    /**
     * @test
     */
    public function searching_for_a_company_by_something_other_than_name_returns_an_empty_collection()
    {
        $collection = $this->api->searchCompany('1234567890');

        $this->assertEmpty($collection);
    }

    /**
     * @return array
     */
    private function data(): array
    {
        return
            [
                "accounts" => [
                    "next_accounts" => [
                        "due_on" => "2020-12-31",
                        "period_start_on" => "2019-01-01",
                        "period_end_on" => "2019-12-31",
                        "overdue" => false,
                    ],
                    "overdue" => false,
                    "accounting_reference_date" => [
                        "day" => "31",
                        "month" => "12",
                    ],
                    "next_due" => "2020-12-31",
                    "last_accounts" => [
                        "period_start_on" => "2018-01-01",
                        "period_end_on" => "2018-12-31",
                        "made_up_to" => "2018-12-31",
                        "type" => "full",
                    ],
                    "next_made_up_to" => "2019-12-31",
                ],
                "registered_office_address" => [
                    "postal_code" => "SN16 0RP",
                    "address_line_2" => "Malmesbury",
                    "address_line_1" => "Tetbury Hill",
                    "locality" => "Wiltshire",
                ],
                "last_full_members_list_date" => "2015-07-08",
                "company_number" => "02627406",
                "undeliverable_registered_office_address" => false,
                "company_name" => "DYSON LIMITED",
                "type" => "ltd",
                "sic_codes" => [
                    0 => "27510",
                ],
                "jurisdiction" => "england-wales",
                "date_of_creation" => "1991-07-08",
                "has_been_liquidated" => false,
                "etag" => "60f49fc4021d140f613b5b66675956462b5cadd5",
                "has_insolvency_history" => false,
                "has_charges" => true,
                "company_status" => "active",
                "previous_company_names" => [
                    0 => [
                        "name" => "DYSON APPLIANCES LIMITED",
                        "ceased_on" => "2001-01-02",
                        "effective_from" => "1991-09-06",
                    ],
                    1 => [
                        "effective_from" => "1991-07-08",
                        "ceased_on" => "1991-09-06",
                        "name" => "BARLETA LIMITED",
                    ],
                ],
                "confirmation_statement" => [
                    "last_made_up_to" => "2020-07-08",
                    "next_made_up_to" => "2021-07-08",
                    "next_due" => "2021-07-22",
                    "overdue" => false,
                ],
                "links" => [
                    "self" => "/company/02627406",
                    "filing_history" => "/company/02627406/filing-history",
                    "officers" => "/company/02627406/officers",
                    "charges" => "/company/02627406/charges",
                    "persons_with_significant_control" => "/company/02627406/persons-with-significant-control",
                ],
                "registered_office_is_in_dispute" => false,
                "can_file" => true,
            ];
    }

    private function dataSearchCompany(): array
    {
        return [
            "page_number" => 1,
            "items" => [
                [
                    "company_status" => "active",
                    "kind" => "searchresults#company",
                    "address" => [
                        "postal_code" => "NW9 0BA",
                        "locality" => "London",
                        "address_line_1" => "Coniston Gardens",
                        "country" => "United Kingdom",
                        "premises" => "75",
                    ],
                    "company_type" => "ltd",
                    "description" => "00621952 - Incorporated on 27 February 1959",
                    "links" => [
                        "self" => "/company/00621952",
                    ],
                    "snippet" => "",
                    "address_snippet" => "75 Coniston Gardens, London, United Kingdom, NW9 0BA",
                    "date_of_creation" => "1959-02-27",
                    "title" => "LILA COMPANY LIMITED",
                    "matches" => [
                        "title" => [
                            1,
                            4,
                        ],
                        "snippet" => [],
                    ],
                    "company_number" => "00621952",
                    "description_identifier" => [
                        "incorporated-on",
                    ],
                ],
                [
                    "kind" => "searchresults#company",
                        "address" => [
                        "country" => "England",
                        "premises" => "49",
                        "postal_code" => "SL7 1PE",
                        "address_line_1" => "Dedmere Road",
                        "locality" => "Marlow",
                    ],
                    "company_status" => "active",
                    "company_type" => "ltd",
                    "date_of_creation" => "2020-09-09",
                    "snippet" => "",
                    "links" => [
                        "self" => "/company/12869654",
                    ],
                    "address_snippet" => "49 Dedmere Road, Marlow, England, SL7 1PE",
                    "description" => "12869654 - Incorporated on  9 September 2020",
                    "description_identifier" => [
                        "incorporated-on",
                    ],
                    "company_number" => "12869654",
                    "matches" => [
                        "title" => [
                            1,
                            4,
                        ],
                        "snippet" => [],
                    ],
                    "title" => "LILA AND LION LTD",
                ],
            ],
            "total_results" => 447,
            "items_per_page" => 2,
            "start_index" => 0,
            "kind" => "search#companies",
        ];
    }
}
