CSV Each
=========
[![Version](https://img.shields.io/packagist/v/alva/csv-each.svg)](https://packagist.org/packages/alva/csv-each)
[![License](https://img.shields.io/packagist/l/alva/csv-each.svg)](https://github.com/evgeny-klyopov/csv-each/blob/master/LICENSE)
[![Downloads](https://img.shields.io/packagist/dt/alva/csv-each.svg)](https://packagist.org/packages/alva/csv-each)
[![StyleCI](https://github.styleci.io/repos/162603494/shield?branch=master)](https://github.styleci.io/repos/162603494)

### Features:
- PHP >=7.1
- **stable**
- **fast** Minimal overhead

## Install
```bash
composer require alva/csv-each:1.*
```
```json
{
    "require": {
        "alva/csv-each": "1.*"
    }
}
```

Examples
=======

### Line by line reading
```php
use Alva\CsvEach\Iterate;

foreach ((new Iterate($pathToFile))->each(Iterate::TYPE_TEXT) as $lineNumber => $line) {
    echo '[' . $lineNumber . '] ' . $line . PHP_EOL;
}
```

### Line by line reading and return columns
```php
use Alva\CsvEach\Iterate;

foreach ((new Iterate($pathToFile))->setDelimiter(',')->each(Iterate::TYPE_ARRAY) as $lineNumber => $line) {
    echo '[' . $lineNumber . '] ' . PHP_EOL;
    print_r($line);
}
```

### Byte read
```php
use Alva\CsvEach\Iterate;

foreach ((new Iterate($pathToFile))->each(Iterate::TYPE_BINARY, 5) as $lineNumber => $line) {
    echo '[' . $lineNumber . '] ' . $line . PHP_EOL;
}
```

## Tests

```bash
./vendor/bin/phpunit
```
