# Smmry PHP SDK
[![Latest Stable Version](https://poser.pugx.org/dayrev/smmry-sdk-php/v/stable.png)](https://packagist.org/packages/dayrev/smmry-sdk-php)
[![StyleCI](https://styleci.io/repos/80203543/shield?branch=master)](https://styleci.io/repos/80203543)
[![Dependency Status](https://www.versioneye.com/user/projects/589d94156a7781003b243071/badge.svg?style=flat)](https://www.versioneye.com/user/projects/589d94156a7781003b243071)

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
