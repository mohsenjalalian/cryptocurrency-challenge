<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyPrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'currency_id'
    ];

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order');
    }
}
