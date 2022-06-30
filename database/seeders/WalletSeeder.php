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
            ['address' => Str::random(16), 'balance' => 400000, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')],
            ['address' => Str::random(16), 'balance' => 300000, 'created_at' => Carbon::now()->format('Y-m-d H:i:s'), 'updated_at' => Carbon::now()->format('Y-m-d H:i:s')]
        ];

        Wallet::query()->insert($wallets);
    }
}
