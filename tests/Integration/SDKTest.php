<?php

namespace DayRev\Smmry\Tests\Integration;

use DayRev\Smmry\SDK;
use Mockery;
use stdClass;

class SDKTest extends TestCase
{
    protected $sdk;

    public function setUp()
    {
        $this->sdk = new SDK(['api_key' => $this->config['api_key'], 'summary_length' => 5]);
    }

    public function testApiKeyIsInvalid()
    {
        $sdk = $this->sdk = new SDK(['api_key' => 'INVALID1J3243N090', 'summary_length' => 5]);
        $response = $sdk->summarizeText($this->getTextToSummarize());

        $this->assertInstanceOf('stdClass', $response);
        $this->assertObjectHasAttribute('sm_api_error', $response);
        $this->assertObjectHasAttribute('sm_api_message', $response);
        $this->assertEquals(1, $response->sm_api_error);
        $this->assertEquals('INVALID API KEY', $response->sm_api_message);
    }

    public function testSummarizesExpectedText()
    {
        $response = $this->sdk->summarizeText($this->getTextToSummarize());

        $this->assertInstanceOf('stdClass', $response);
        $this->assertObjectHasAttribute('sm_api_content', $response);
        $this->assertEquals($this->getExpectedTextSummary()->sm_api_content, $response->sm_api_content);
    }

    public function testSummarizesExpectedUrlText()
    {
        $response = $this->sdk->summarizeUrl(
            'http://collegefootball.ap.org/article/mayfield-leads-oklahoma-35-19-sugar-bowl-win-over-auburn'
        );

        $this->assertInstanceOf('stdClass', $response);
        $this->assertObjectHasAttribute('sm_api_content', $response);
        $this->assertEquals($this->getExpectedUrlTextSummary()->sm_api_content, $response->sm_api_content);
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
