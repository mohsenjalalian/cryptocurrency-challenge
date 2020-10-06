<?php

if (!function_exists('calculateResultAmount')) {
    function calculateResultAmount(array $validatedData, array $lastSourcePrice, array $lastDestinationPrice)
    {
        if ($validatedData['destination_currency'] == config('app.base_currency')) {
            $validatedData['result_amount'] = $lastSourcePrice['price'] * $validatedData['amount'];
            $validatedData['source_currency_price_id'] = $lastSourcePrice['currency_price_id'];
        } elseif ($validatedData['source_currency'] == config('app.base_currency')) {
            $validatedData['result_amount'] = 1 / $lastSourcePrice['price'] * $validatedData['amount'];
            $validatedData['destination_currency_price_id'] = $lastDestinationPrice['currency_price_id'];
        } else {
            $validatedData['result_amount'] = $lastSourcePrice['price'] / $lastDestinationPrice['price'] * $validatedData['amount'];
            $validatedData['source_currency_price_id'] = $lastSourcePrice['currency_price_id'];
            $validatedData['destination_currency_price_id'] = $lastDestinationPrice['currency_price_id'];
        }

        return $validatedData;
    }
}
