<p align="center">

![](./companies-house-laravel.png)

</p>

# A Laravel wrapper to get companies house information and validate company numbers

[![Latest Version on Packagist](https://img.shields.io/packagist/v/juststeveking/companies-house-laravel.svg?style=flat-square)](https://packagist.org/packages/juststeveking/companies-house-laravel)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/juststeveking/companies-house-laravel/run-tests?label=tests)](https://github.com/juststeveking/companies-house-laravel/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/juststeveking/companies-house-laravel.svg?style=flat-square)](https://packagist.org/packages/juststeveking/companies-house-laravel)


A Laravel wrapper to get companies house information and validate company numbers. This is a work in progress and more methods will be added to the API as they are required. Currently only Company Number is able to be passed to the API.
## Installation

You can install the package via composer:

```bash
composer require juststeveking/companies-house-laravel
```

You can publish the config file with:
```bash
php artisan vendor:publish --provider="JustSteveKing\CompaniesHouseLaravel\CompaniesHouseLaravelServiceProvider" --tag="config"
```

This is the contents of the published config file:

```php
return [
    'api' => [
        'key' => env('COMPANIES_HOUSE_KEY', ''),
        'url' => env('COMPANIES_HOUSE_URL', 'https://api.companieshouse.gov.uk')
    ]
];
```

## Usage

Using it inline:

``` php
use JustSteveKing\CompaniesHouseLaravel\Client;

// Make a new client
$api = Client::make();

// Get Company information from a company number
$company = $api->company('company-number');
```

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
