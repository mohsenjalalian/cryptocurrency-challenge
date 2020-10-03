<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'email' => $this->email,
            'amount' => $this->amount,
            'source currency' => new CurrencyResource($this->sourceCurrency),
            'destination currency' => new CurrencyResource($this->destinationCurrency),
            'tracking code' => $this->tracking_code,
            'result amount' => $this->result_amount,
        ];
    }
}
