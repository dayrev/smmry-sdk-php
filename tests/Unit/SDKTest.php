<?php

namespace DayRev\Smmry\Tests\Unit;

use DayRev\Smmry\SDK;

class SDKTest extends \PHPUnit_Framework_TestCase
{
    public function testContainsDynamicProperties()
    {
        $sdk = new SDK(array('api_key' => 'D74KLJ345UH9SHDF1', 'summary_length' => 5));

        $this->assertObjectHasAttribute('api_key', $sdk);
        $this->assertAttributeEquals('D74KLJ345UH9SHDF1', 'api_key', $sdk);

        $this->assertObjectHasAttribute('summary_length', $sdk);
        $this->assertAttributeEquals(5, 'summary_length', $sdk);
    }
}
