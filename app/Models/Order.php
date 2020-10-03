<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'source_currency_id',
        'destination_currency_id',
        'amount',
        'result_amount',
        'source_currency_price_id',
        'destination_currency_price_id',
        'tracking_code'
    ];

    public function sourceCurrency()
    {
        return $this->belongsTo('App\Models\Currency');
    }

    public function destinationCurrency()
    {
        return $this->belongsTo('App\Models\Currency');
    }

    public function sourceCurrencyPrice()
    {
        return $this->belongsTo('App\Models\CurrencyPrice');
    }

    public function destinationCurrencyPrice()
    {
        return $this->belongsTo('App\Models\CurrencyPrice');
    }
}
