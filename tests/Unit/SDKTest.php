<?php

namespace DayRev\Smmry\Tests\Unit;

use DayRev\Smmry\SDK;

class SDKTest extends \PHPUnit_Framework_TestCase
{
    protected $sdk;

    public function setUp()
    {
        $this->sdk = new SDK(['api_key' => 'D74KLJ345UH9SHDF1', 'summary_length' => 5]);
    }

    public function testContainsDynamicProperties()
    {
        $this->assertObjectHasAttribute('api_key', $this->sdk);
        $this->assertAttributeEquals('D74KLJ345UH9SHDF1', 'api_key', $this->sdk);

        $this->assertObjectHasAttribute('summary_length', $this->sdk);
        $this->assertAttributeEquals(5, 'summary_length', $this->sdk);
    }
}
