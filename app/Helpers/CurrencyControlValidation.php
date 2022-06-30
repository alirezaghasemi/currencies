<?php

namespace App\Helpers;


use App\Models\Currency;

trait CurrencyControlValidation
{
    public static function checkCurrencyAllowTrade($currency)
    {
        $currency = Currency::query()->find($currency);
        if (isset($currency)) {
            return 'true';
        } else {
            return 'false';
        }
    }
}
