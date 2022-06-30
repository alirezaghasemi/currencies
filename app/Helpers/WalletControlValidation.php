<?php

namespace App\Helpers;

use App\Models\Wallet;

trait WalletControlValidation
{
    /* بررسی اعتبار آدرس کیف پول */
    public static function checkWalletAddress($address)
    {
        if (Wallet::query()->where('address', '=', $address)->exists()) {
            return 'true';
        } else {
            return 'false';
        }
    }

    /* بررسی حجم سفارش نسبت به کیف پول */
    public static function checkWalletBalance($address, $transaction_volume)
    {
        $wallet = Wallet::query()->where('address', '=', $address)->first();
        if ($wallet->balance >= $transaction_volume) {
            return 'true';
        } else {
            return 'false';
        }
    }
}
