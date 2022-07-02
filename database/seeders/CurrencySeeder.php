<?php

namespace Database\Seeders;

use App\Models\Currency;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{

    public function run()
    {
        $currencies = [
            ['name' => 'Bitcoin', 'symbol' => 'btc', 'fee' => 30, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Ethereum', 'symbol' => 'eth', 'fee' => 20, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['name' => 'Tron', 'symbol' => 'trx', 'fee' => 10, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ];

        Currency::query()->insert($currencies);
    }
}
