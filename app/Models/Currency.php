<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;


    public function currencyPrices()
    {
        return $this->hasMany('App\Models\CurrencyPrice');
    }
}
