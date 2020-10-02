<?php


namespace App\Adapters\ExchangeRates;


interface ExchangeRateAdapterInterface
{
    public function convert(string $from, string $to);
}
