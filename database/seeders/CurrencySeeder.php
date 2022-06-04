<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('currency')->insert([
            [
                'name'          => 'USD',
                'exchange_rate' => 1.000000,
                'base_currency' => 1,
                'status'        => 1,
            ],
            [
                'name'          => 'EUR',
                'exchange_rate' => 0.910000,
                'base_currency' => 0,
                'status'        => 1,
            ],
            [
                'name'          => 'ZAR',
                'exchange_rate' => 15.00000,
                'base_currency' => 0,
                'status'        => 1,
            ],
            [
                'name'          => 'ZWL',
                'exchange_rate' => 240.00000,
                'base_currency' => 0,
                'status'        => 1,
            ],
        ]);
    }
}
