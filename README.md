## Overview

A simple SDK interface for interacting with the [Smmry](http://smmry.com) text summarization API.

## Installation
Run the following [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) command to add the package to your project:

```
composer require dayrev/smmry-sdk-php
```

Alternatively, add `"dayrev/smmry-sdk-php": "^1.0"` to your composer.json file.

##Usage
```php
$sdk = new DayRev\Smmry\SDK(['api_key' => 'YOURKEYHERE', 'summary_length' => 5]);
$summary = $sdk->summarizeUrl('http://collegefootball.ap.org/article/mayfield-leads-oklahoma-35-19-sugar-bowl-win-over-auburn');
```

## Tests
To run the test suite, run the following commands from the root directory:

```
composer install
vendor/bin/phpunit
```
