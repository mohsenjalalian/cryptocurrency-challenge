<?php


namespace App\Repositories;


use App\Models\CurrencyPrice;
use Exception;

class CurrencyPriceRepository implements RepositoryInterface
{
    /**
     * @param array $attributes
     * @return false
     */
    public function create(array $attributes)
    {
        try {
            return CurrencyPrice::create($attributes);
        } catch (Exception $exception) {
            return false;
        }
    }

    public function findOneBy(string $attribute, $value, array $columns)
    {
        // TODO: Implement findBy() method.
    }
}
