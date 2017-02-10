<?php

namespace DayRev\Smmry\Tests\Integration;

use DayRev\Smmry\SDK;
use Mockery;
use ReflectionProperty;
use stdClass;

class SDKTest extends TestCase
{
    protected $sdk;
    protected $mock = true;

    public function setUp()
    {
        $this->sdk = new SDK(['api_key' => 'D74KLJ345UH9SHDF1', 'summary_length' => 5]);
    }

    public function testSummarizesExpectedText()
    {
        if ($this->mock) {
            $requester = Mockery::mock('Curl')
                ->shouldReceive('post')
                ->andReturn($this->getExpectedTextSummary())
                ->getMock();
            $this->setProtectedSDKProperty($this->sdk, 'requester', $requester);
        }

        $response = $this->sdk->summarizeText($this->getTextToSummarize());

        $this->assertInstanceOf('stdClass', $response);
        $this->assertObjectHasAttribute('sm_api_content', $response);
        $this->assertEquals($this->getExpectedTextSummary()->sm_api_content, $response->sm_api_content);
    }

    public function testSummarizesExpectedUrlText()
    {
        if ($this->mock) {
            $requester = Mockery::mock('Curl')
                ->shouldReceive('get')
                ->andReturn($this->getExpectedUrlTextSummary())
                ->getMock();
            $this->setProtectedSDKProperty($this->sdk, 'requester', $requester);
        }

        $response = $this->sdk->summarizeUrl('http://collegefootball.ap.org/article/mayfield-leads-oklahoma-35-19-sugar-bowl-win-over-auburn');

        $this->assertInstanceOf('stdClass', $response);
        $this->assertObjectHasAttribute('sm_api_content', $response);
        $this->assertEquals($this->getExpectedUrlTextSummary()->sm_api_content, $response->sm_api_content);
    }

    protected function setProtectedSDKProperty(SDK $sdk, string $property, $value)
    {
        $reflected_property = new ReflectionProperty(get_class($sdk), $property);
        $reflected_property->setAccessible(true);
        $reflected_property->setValue($sdk, $value);
    }

    protected function getExpectedSummary(string $text): stdClass
    {
        $summary = new stdClass();
        $summary->sm_api_title = '';
        $summary->sm_api_content = $text;

        return $summary;
    }

    protected function getExpectedTextSummary(): stdClass
    {
        return $this->getExpectedSummary(
            file_get_contents(__DIR__ . '/../Data/summarized-text.txt')
        );
    }

    protected function getExpectedUrlTextSummary(): stdClass
    {
        return $this->getExpectedSummary(
            file_get_contents(__DIR__ . '/../Data/summarized-url.txt')
        );
    }

    protected function getTextToSummarize(): string
    {
        return file_get_contents(__DIR__ . '/../Data/full-text.txt');
    }
}
