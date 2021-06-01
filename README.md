# Saga Message Producer Bridge

## Table Of Contents
- [Requirements](#requirements)
- [About package](#about-package)
- [Installation](#installation)
- [Usage](#usage)
- [License](#license)

## Requirements  
- php: ^7.1
- [phpsagas/contracts](https://github.com/phpsagas/contracts): ^0.0
- symfony/messenger: ^4.0

## About package
This component is the part of [phpsagas framework](https://github.com/phpsagas).  
The package contains implementation of saga message producer based on [symfony/messenger](https://packagist.org/packages/symfony/messenger).

## Installation
You can install the package using [Composer](https://getcomposer.org/):
```bash
composer require phpsagas/messenger-bridge
```

## Usage
You can use `AMQPMessageProducer` as `MessageProducerInterface` implementation.

## License
Saga message producer bridge is released under the [MIT license](LICENSE). 
