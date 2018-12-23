CSV Each
=========

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

foreach ((new Iterate($pathToFile))->each(Iterate::TYPE_BINARY) as $lineNumber => $line) {
    echo '[' . $lineNumber . '] ' . $line . PHP_EOL;
}
```

## Tests

```bash
./vendor/bin/phpunit
```