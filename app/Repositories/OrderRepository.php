<?php

namespace App\Repositories;

use App\Interfaces\OrderRepositoryInterface;
use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{

    public function setOrders(array $order_details)
    {
        return Order::query()->create($order_details);
    }


    public function getAllUserOrders($user_id)
    {
        return Order::query()->where('user_id', '=', $user_id)->get();
    }
}
