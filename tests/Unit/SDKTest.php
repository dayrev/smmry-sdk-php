<?php

namespace DayRev\Smmry\Tests\Unit;

use DayRev\Smmry\SDK;
use ReflectionMethod;
use stdClass;

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

    public function testCleanSummary()
    {
        $summary = new stdClass();
        $summary->sm_api_title = ' Greeting ';
        $summary->sm_api_content = ' Hello, how are you? ';
        $summary->sm_api_img_url = ' http://smmry.com/sm_images/sm_logo.png ';

        $summary = $this->invokeProtectedSdkMethod('cleanSummary', [$summary]);

        $this->assertEquals('Greeting', $summary->sm_api_title);
        $this->assertEquals('Hello, how are you?', $summary->sm_api_content);
        $this->assertEquals(' http://smmry.com/sm_images/sm_logo.png ', $summary->sm_api_img_url);
    }

    public function testBuildUrl()
    {
        $url = $this->invokeProtectedSdkMethod('buildUrl', [['SM_QUOTE_AVOID' => 1]]);

        $this->assertEquals(
            'http://api.smmry.com?SM_API_KEY=D74KLJ345UH9SHDF1&SM_LENGTH=5&SM_QUOTE_AVOID=1',
            $url
        );
    }

    protected function invokeProtectedSdkMethod(string $method, array $args = [])
    {
        $reflection = new ReflectionMethod(get_class($this->sdk), $method);
        $reflection->setAccessible(true);

        return $reflection->invokeArgs($this->sdk, $args);
    }
}
