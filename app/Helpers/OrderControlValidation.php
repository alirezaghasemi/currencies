<?php

namespace App\Helpers;

use App\Models\Currency;
use App\Models\Wallet;

class OrderControlValidation
{
    use CurrencyControlValidation, WalletControlValidation;

    /* بررسی سه شرط ذکر شده */
    public static function fullCheck($address, $currency, $transaction_volume)
    {
        $wallet_exists = WalletControlValidation::checkWalletAddress($address);

        $allow_trade = CurrencyControlValidation::checkCurrencyAllowTrade($currency);

        $wallet_transaction_volume = WalletControlValidation::checkWalletBalance($address, $transaction_volume);

        if ($wallet_exists == 'false' || $allow_trade == 'false' || $wallet_transaction_volume == 'false') {
            return 'false';
        } else {
            return 'true';
        }
    }

    /* محاسبات فی */
    public static function calculateFee($currency, $transaction_volume)
    {
        $currency = Currency::query()->find($currency);

        $multiplication = $transaction_volume * $currency->fee;
        $division = $multiplication / 100;

        return ['division' => $division, 'total' => ($transaction_volume - $division)];
    }

    /* محاسبه بروزرسانی کیف پول */
    public static function calculateWalletBalance($address, $transaction_volume)
    {
        $wallet = Wallet::query()->where('address', '=', $address)->first();
        $balance = abs($wallet->balance - $transaction_volume);
        return $balance;
    }
}
