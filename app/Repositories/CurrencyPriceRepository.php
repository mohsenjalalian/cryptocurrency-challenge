<?php


namespace App\Repositories;


use App\Models\CurrencyPrice;
use Exception;

class CurrencyPriceRepository implements RepositoryInterface
{
    public function create(array $attributes)
    {
        try {
            CurrencyPrice::create($attributes);

            return true;
        } catch (Exception $exception) {
            return false;
        }
    }
}
