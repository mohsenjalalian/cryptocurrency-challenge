<?php

namespace Tests\Feature;

use App\Models\Currency;
use App\Models\CurrencyPrice;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Str;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use RefreshDatabase;

    public function testShow()
    {
        $payload = [
            'email' => 'jalalianmohsen@gmail.com',
            'source_currency' => 'USD',
            'destination_currency' => 'IRR',
            'amount' => '1000',
        ];

        $sourceCurrency = Currency::where('symbol', $payload['source_currency'])->get(['id'])->first();
        $destinationCurrency = Currency::where('symbol', $payload['destination_currency'])->get(['id'])->first();

        $sourceCurrencyPriceAttributes = [
            'price' => (int)100,
            'currency_id' => $sourceCurrency->id
        ];

        $sourceCurrencyPrice = CurrencyPrice::create($sourceCurrencyPriceAttributes);

        $destinationCurrencyPriceAttributes = [
            'price' => (int)1,
            'currency_id' => $destinationCurrency->id
        ];

        $destinationCurrencyPrice = CurrencyPrice::create($destinationCurrencyPriceAttributes);

        $data['tracking_code'] = Str::uuid()->toString();
        $data['email'] = $payload['email'];
        $data['amount'] = $payload['amount'];
        $data['source_currency_id'] = $sourceCurrency->id;
        $data['source_currency'] = $sourceCurrency;
        $data['destination_currency_id'] = $destinationCurrency->id;
        $data['destination_currency'] = $destinationCurrency;
        $data['source_currency_price_id'] = $sourceCurrencyPrice->id;
        $data['destination_currency_price_id'] = $destinationCurrencyPrice->id;
        $lastSourcePrice =['price' => $sourceCurrencyPrice->price, 'currency_price_id' => $sourceCurrencyPrice->id];
        $lastDestinationPrice =['price' => $destinationCurrencyPrice->price, 'currency_price_id' => $destinationCurrencyPrice->id];
        $data = calculateResultAmount($data, $lastSourcePrice, $lastDestinationPrice);
        unset($data['source_currency']);
        unset($data['destination_currency']);

        $order = Order::create($data);

        $response = $this->get('/api/orders?tracking_code='. $order->tracking_code);

        $response->assertStatus(200);
    }

    /**
     *
     */
    public function testStore()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
