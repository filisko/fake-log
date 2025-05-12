# Fake PSR-3 logger

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE)
![Testing][ico-tests]
![Coverage Status][ico-coverage]
[![Total Downloads][ico-downloads]][link-downloads]

A package that provides a simple PSR-3 implementation for integration tests.

## Requirements

* PHP >= 7.1

## Installation

This package is installable and autoloadable via Composer as [filisko/fake-psr3-logger](https://packagist.org/packages/filisko/fake-psr3-logger).

```sh
composer require filisko/fake-psr3-logger --dev
```

## Usage

This package provides a [PSR-3](http://www.php-fig.org/psr/psr-3/) (`Psr\Log\LoggerInterface`) implementation that allows you to verify the logging your code has made.

```php
use Filisko\FakeLogger;

// PHP Unit scenario

$logger = new FakeLogger();
$logger->info('Something interesting happened', [
    'user_id' => 1
]);

// logs exposed
$logs = $logger->logs();

$this->assertSame([
    [
        'level' => 'info',
        'message' => 'Something interesting happened',
        'context' => [
            'user_id' => 1,
        ],
    ]
], $logs);

$this->assertSame(1, $logger->count());
```

## Other testing utilities

- PSR-16 fake cache: [kodus/mock-cache](https://github.com/kodus/mock-cache)
- PSR-15 middleware dispatcher: [middlewares/utils](https://github.com/middlewares/utils?tab=readme-ov-file#dispatcher) (used in conjuction with PSR-7 and PSR-17)
- Testable PHP functions: [filisko/testable-phpfunctions](https://github.com/filisko/testable-phpfunctions)

---

Please see [CHANGELOG](CHANGELOG.md) for more information about recent changes and [CONTRIBUTING](CONTRIBUTING.md) for contributing details.

The MIT License (MIT). Please see [LICENSE](LICENSE) for more information.

[ico-version]: https://img.shields.io/packagist/v/filisko/fake-psr3-logger.svg?style=flat
[ico-license]: https://img.shields.io/badge/license-MIT-informational.svg?style=flat
[ico-tests]: https://github.com/filisko/fake-psr3-logger/workflows/testing/badge.svg
[ico-coverage]: https://coveralls.io/repos/github/filisko/fake-psr3-logger/badge.svg?branch=main
[ico-downloads]: https://img.shields.io/packagist/dt/filisko/fake-psr3-logger.svg?style=flat

[link-packagist]: https://packagist.org/packages/filisko/fake-psr3-logger
[link-downloads]: https://packagist.org/packages/filisko/fake-psr3-logger

