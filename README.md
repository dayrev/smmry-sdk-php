## Overview

A simple SDK interface for interacting with the [Smmry](http://smmry.com) text summarization API.

##Usage

    $sdk = new DayRev\Smmry\SDK(array('api_key' => 'YOURKEYHERE', 'summary_length' => 5));
    $summary = $sdk->summarizeUrl('http://collegefootball.ap.org/article/mayfield-leads-oklahoma-35-19-sugar-bowl-win-over-auburn');

## Tests
To run the test suite, install [composer](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) and then run the following commands from the root directory:

```
composer install
vendor/bin/phpunit
```
