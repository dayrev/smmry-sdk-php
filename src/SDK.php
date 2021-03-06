<?php

namespace DayRev\Smmry;

use Curl\Curl;
use stdClass;

class SDK
{
    /**
     * The request handler.
     *
     * @var object
     */
    protected $requester;

    /**
     * The API key for requests.
     *
     * @var string
     */
    protected $api_key;

    /**
     * The max length of the summarized text - in sentences.
     *
     * @var int
     */
    protected $summary_length;

    /**
     * Initializes the class.
     *
     * @param array $data Key value data to populate object properties.
     *
     * @return void
     */
    public function __construct(array $data = [])
    {
        $this->loadData($data);
        $this->requester = new Curl();
    }

    /**
     * Summarizes a string of text.
     *
     * @param string $text The text to summarize.
     *
     * @return stdClass
     */
    public function summarizeText(string $text): stdClass
    {
        $summary = $this->requester->post($this->buildUrl(), [
            'sm_api_input' => $text,
        ]);

        return $this->cleanSummary($summary);
    }

    /**
     * Summarizes the text content of a url.
     *
     * @param string $url The url of text content to summarize.
     *
     * @return stdClass
     */
    public function summarizeUrl(string $url): stdClass
    {
        $summary = $this->requester->get($this->buildUrl(['SM_URL' => $url]));

        return $this->cleanSummary($summary);
    }

    /**
     * Attempts to map array data to object properties.
     *
     * @param array $data Key value data to populate object properties.
     *
     * @return void
     */
    protected function loadData(array $data = [])
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    /**
     * Builds the API request URL.
     *
     * @param array $data Key value data to populate URL params.
     *
     * @return string
     */
    protected function buildUrl(array $data = []): string
    {
        $params = array_merge([
            'SM_API_KEY' => $this->api_key,
            'SM_LENGTH' => $this->summary_length,
        ], $data);

        $url  = 'http://api.smmry.com';
        $url .= '?' . http_build_query($params);

        return $url;
    }

    /**
     * Cleans summary response values.
     *
     * @param stdClass $summary The summary response to clean.
     *
     * @return stdClass
     */
    protected function cleanSummary(stdClass $summary): stdClass
    {
        $properties = ['sm_api_title', 'sm_api_content'];
        foreach ($properties as $property) {
            if (!property_exists($summary, $property)) {
                continue;
            }

            $summary->$property = trim($summary->$property);
        }

        return $summary;
    }
}
