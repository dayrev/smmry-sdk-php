# Smmry PHP SDK
[![Build Status](https://travis-ci.org/dayrev/smmry-sdk-php.svg?branch=master)](https://travis-ci.org/dayrev/smmry-sdk-php)
[![Coverage Status](https://coveralls.io/repos/github/dayrev/smmry-sdk-php/badge.svg)](https://coveralls.io/github/dayrev/smmry-sdk-php)
[![Latest Stable Version](https://poser.pugx.org/dayrev/smmry-sdk-php/v/stable.png)](https://packagist.org/packages/dayrev/smmry-sdk-php)

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
$summary = $sdk->summarizeText($long_text_string_here);
```

**OR**

```php
$sdk = new DayRev\Smmry\SDK(['api_key' => 'YOURKEYHERE', 'summary_length' => 5]);
$summary = $sdk->summarizeUrl('http://collegefootball.ap.org/article/mayfield-leads-oklahoma-35-19-sugar-bowl-win-over-auburn');
```

## Tests
To run the test suite, run the following commands from the root directory:

```
composer install
vendor/bin/phpunit -d api_key=YOUR_SMMRY_API_KEY
```

> **Note:** A valid Smmry API key is required when running the integration tests.
