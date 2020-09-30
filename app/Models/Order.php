<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;


    public function sourceCurrency()
    {
        return $this->belongsTo('App\Models\CurrencyPrice');
    }

    public function destinationCurrency()
    {
        return $this->belongsTo('App\Models\CurrencyPrice');
    }
}
