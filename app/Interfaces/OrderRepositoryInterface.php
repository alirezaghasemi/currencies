<?php

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    /* دریافت تمام سفارشات */
    public function getAllUserOrders($user_id);

    /* ذخیره سفارش جدید */
    public function setOrders(array $order_details);
}
