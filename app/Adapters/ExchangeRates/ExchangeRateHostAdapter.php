<?php

namespace App\Adapters\ExchangeRates;

use GuzzleHttp\Client;
use Exception;
use GuzzleHttp\Exception\GuzzleException;

class ExchangeRateHostAdapter implements ExchangeRateAdapterInterface
{
    private $client;
    private $baseUrl = 'https://api.exchangerate.host';
    private $convertMethod = 'convert';

    /**
     * ExchangeRateHostAdapter constructor.
     * @param Client $client
     */
    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @param string $from
     * @param string $to
     * @return false
     * @throws GuzzleException
     */
    public function convert(string $from, string $to)
    {
        $url = $this->getConvertUrl($from, $to);
        try {
            $response = $this->client->request('GET', $url);

            $contents = json_decode($response->getBody()->getContents());

            return $contents->info->rate;
        } catch (Exception $exception) {
            return false;
        }
    }

    /**
     * @param string $from
     * @param string $to
     * @return string
     */
    private function getConvertUrl(string $from, string $to)
    {
        return $this->getBaseUrl(). '/' . $this->convertMethod . '?from=' . $from . '&' . 'to=' . $to;
    }

    /**
     * @return string
     */
    private function getBaseUrl()
    {
        return $this->baseUrl;
    }
}
