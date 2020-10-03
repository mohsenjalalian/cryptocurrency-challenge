<?php

namespace App\Repositories;

use App\Models\Currency;

class CurrencyRepository implements RepositoryInterface
{
    public function create(array $attributes)
    {
        // TODO: Implement create() method.
    }

    public function findOneBy(string $attribute, $value, array $columns)
    {
        return Currency::where($attribute, $value)->get($columns)->first();
    }
}
