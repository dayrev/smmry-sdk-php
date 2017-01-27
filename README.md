## Overview

A simple SDK interface for interacting with the [Smmry](http://smmry.com) text summarization API.

##Usage

    $sdk = new DayRev\Smmry\SDK(array('api_key' => 'YOURKEYHERE', 'summary_length' => 5));
    $summary = $sdk->summarizeUrl('http://collegefootball.ap.org/article/mayfield-leads-oklahoma-35-19-sugar-bowl-win-over-auburn');
