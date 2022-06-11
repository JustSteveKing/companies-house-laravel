# Laravel Companies House

<p align="center">

![](./companies-house-laravel.png)

</p>

[![Latest Version on Packagist](https://img.shields.io/packagist/v/juststeveking/companies-house-laravel.svg?style=flat-square)](https://packagist.org/packages/juststeveking/companies-house-laravel)
![Tests](https://github.com/juststeveking/companies-house-laravel/workflows/Tests/badge.svg?branch=master)
[![Total Downloads](https://img.shields.io/packagist/dt/juststeveking/companies-house-laravel.svg?style=flat-square)](https://packagist.org/packages/juststeveking/companies-house-laravel)


A Laravel wrapper to get companies house information and validate company numbers.

## Installation

You can install the package via composer:

```bash
composer require juststeveking/companies-house-laravel
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="JustSteveKing\CompaniesHouse\CompaniesHouseServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
    'api' => [
        'key' => env('COMPANIES_HOUSE_KEY', ''),
        'url' => env('COMPANIES_HOUSE_URL', 'https://api.company-information.service.gov.uk'),
        'timeout' => env('COMPANIES_HOUSE_TIMEOUT', 10),
        'retry' => [
            'times' => env('COMPANIES_HOUSE_RETRY_TIMES', null),
            'milliseconds' => env('COMPANIES_HOUSE_RETRY_MILLISECONDS', null),
        ],
    ]
];
```

## Usage

This library is aimed to be easy to use, and slots into Laravel with no issues.

The package will install a Service Provider for you, meaning that all you need to do is resolve the `Client` from the container, and start using it.


### Get A Company Profile

To get a company profile, you can quite simply:

```php
use JustSteveKing\CompaniesHouse\Client;

class CompanyController extends Controller
{
    public function __construct(
        protected Client $service,
    ) {}

    public function __invoke(Request $request)
    {
        $company = $this->service->company(
            companyNumber: $request->get('company_number')
        );
    }
}
```


## Get A Companies Officers

You can get a `Collection` of Company Officers using the companies number:

```php
use JustSteveKing\CompaniesHouse\Client;

class CompanyOfficersController extends Controller
{
    public function __construct(
        protected Client $service,
    ) {}

    public function __invoke(Request $request)
    {
        $company = $this->service->officers(
            companyNumber: $request->get('company_number')
        );
    }
}
```


### Get a specific Officer from a Company

You can get an `Officer` from a company using the company number and their appointment ID:

```php
use JustSteveKing\CompaniesHouse\Client;

class CompanyOfficerController extends Controller
{
    public function __construct(
        protected Client $service,
    ) {}

    public function __invoke(Request $request)
    {
        $company = $this->service->officer(
            companyNumber: $request->get('company_number'),
            appointmentId: $request->get('appointment_id'),
        );
    }
}
```


### Searching

There are a few options when it comes to searching, you can search for:

- companies
- officers
- disqualified officers
- search all


#### Searching for Companies

This will return a `SearchCollection`

```php
use JustSteveKing\CompaniesHouse\Client;

class CompanySearchController extends Controller
{
    public function __construct(
        protected Client $service,
    ) {}

    public function __invoke(Request $request)
    {
        $results = $this->service->searchCompany(
            query: $request->get('query'),
            perPage: 25, //optional
            startIndex: 0, //optional
        );
    }
}
```


#### Searching for Officers

This will return a `SearchCollection`

```php
use JustSteveKing\CompaniesHouse\Client;

class OfficersSearchController extends Controller
{
    public function __construct(
        protected Client $service,
    ) {}

    public function __invoke(Request $request)
    {
        $results = $this->service->searchOfficers(
            query: $request->get('query'),
            perPage: 25, //optional
            startIndex: 0, //optional
        );
    }
}
```


#### Searching everything

This will return a `SearchCollection`

```php
use JustSteveKing\CompaniesHouse\Client;

class SearchController extends Controller
{
    public function __construct(
        protected Client $service,
    ) {}

    public function __invoke(Request $request)
    {
        $results = $this->service->search(
            query: $request->get('query'),
            perPage: 25, //optional
            startIndex: 0, //optional
        );
    }
}
```

## Validation

Using the validation inline:

```php
$this->validate($request, [
    'company_number' => [
        'required',
        'string',
        Rule::companyNumber()
    ]
]);
```


## Testing

To understand how to use this part please follow the Laravel documentation for [Testing the Http Client](https://laravel.com/docs/8.x/http-client#testing)



Run the unit tests:

``` bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email juststevemcd@gmail.com instead of using the issue tracker.

## Credits

- [Steve McDougall](https://github.com/JustSteveKing)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
