# Fake PSR-3 logger

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
![Testing][ico-ga]
[![Total Downloads][ico-downloads]][link-downloads]

A simpole package that provides a PSR-3 implementation for integration tests.

## Requirements

* In comparison to most packages, it starts providing support from **PHP >= 7.2**

## Installation

This package is installable and autoloadable via Composer as [filisko/fake-psr3-logger](https://packagist.org/packages/filisko/fake-psr3-logger).

```sh
composer require filisko/fake-psr3-logger --dev
```

## Usage

This package provides a [PSR-3](http://www.php-fig.org/psr/psr-3/) (`Psr\Log\LoggerInterface`) implementation standard to store the logs.

```php
use Filisko\FakeLogger;

// PHP Unit scenario

$logger = new FakeLogger();
$logger->info('Something interesting happened', [
    'gold' => 'found'
]);

$this->assertSame([
    [
        'level' => 'info',
        'message' => 'Something interesting happened',
        'context' => [
            'user_id' => 1,
        ],
    ]
], $logger->logs());

$this->assertSame(1, $logger->count());
```

---

Please see [CHANGELOG](CHANGELOG.md) for more information about recent changes and [CONTRIBUTING](CONTRIBUTING.md) for contributing details.

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/filisko/fake-psr3-logger.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-ga]: https://github.com/filisko/fake-psr3-logger/workflows/testing/badge.svg
[ico-downloads]: https://img.shields.io/packagist/dt/filisko/fake-psr3-logger.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/filisko/fake-psr3-logger
[link-downloads]: https://packagist.org/packages/filisko/fake-psr3-logger
