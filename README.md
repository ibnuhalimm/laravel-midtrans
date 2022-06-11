# Laravel - Midtrans

[![Latest Version on Packagist](https://img.shields.io/packagist/v/ibnuhalimm/laravel-midtrans.svg?style=flat-square)](https://packagist.org/packages/ibnuhalimm/laravel-midtrans)
[![Total Downloads](https://img.shields.io/packagist/dt/ibnuhalimm/laravel-midtrans.svg?style=flat-square)](https://packagist.org/packages/ibnuhalimm/laravel-midtrans)

Laravel wrapper for [Midtrans](https://midtrans.com/) payment gateway.

## Contents
- [Requirements](#requirements)
- [Installation](#installation)
- [Setting Up](#setting-up)
- [Usage](#usage)
- [Testing](#testing)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Security](#security)
- [Credits](#credits)
- [License](#license)

## Requirements
1. [Sign Up](https://midtrans.com/id/passport) for the Midtrans Account

## Installation

You can install the package via composer:

```bash
composer require ibnuhalimm/laravel-midtrans
```

Optionally, you can publish the config file of this package with this command:
```bash
php artisan vendor:publish --tag="laravel-midtrans-config"
```

## Setting up
Put some environment variable to `.env` file:
```bash
MIDTRANS_SERVER_KEY=
MIDTRANS_CLIENT_KEY=
MIDTRANS_MODE=
```

## Usage
You can directly use the `Midtrans` Facade (the alias or class itself):

1. Payment
    #### Get Snap Token
    ```php
    use Ibnuhalimm\LaravelMidtrans\Facades\Midtrans;

    $transactionData = [
        'transaction_details' => [
            'order_id' => 'INV-0012',
            'gross_amount' => 20000,
        ]
    ];

    Midtrans::getSnapToken($transactionData);
    ```
<br><br>

2. After Payment
    #### Check Transaction Status
    ```php
    use Ibnuhalimm\LaravelMidtrans\Facades\Midtrans;

    $id = '9b5192c4-4da4-3b6d-945b-4bf5f853cb56';
    Midtrans::transaction($id)->getDetails();
    ```
<br>

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email **ibnuhalim@pm.me** instead of using the issue tracker.

## Credits

-   [Ibnu Halim Mustofa](https://github.com/ibnuhalimm)
-   [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

