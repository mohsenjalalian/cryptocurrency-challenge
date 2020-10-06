<?php


namespace App\Repositories;


use App\Models\Order;
use Exception;

class OrderRepository implements RepositoryInterface
{
    /**
     * @param array $attributes
     * @return bool
     */
    public function create(array $attributes)
    {
        //todo should handle exception
        try {
            return Order::create($attributes);
        } catch (Exception $exception) {
            return false;
        }
    }

    public function findOneBy(string $attribute, $value, array $columns = ['*'])
    {
        return Order::where($attribute, $value)->get($columns)->first();
    }
}
