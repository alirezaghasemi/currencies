<?php

namespace Database\Seeders;

use App\Models\Wallet;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class WalletSeeder extends Seeder
{

    public function run()
    {
        $wallets = [
            ['address' => Str::random(16), 'balance' => '8937834823428923468324565345435000000000000000000000000000000000',
             'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['address' => Str::random(16), 'balance' => '8937834823428923468324565345435000000000000000000000000000000001',
             'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ];

        Wallet::query()->insert($wallets);
    }
}
