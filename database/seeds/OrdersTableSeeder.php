<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('orders')->insert([
            'id' => 1,
            'client_id' => 1,
            'total'  => '1000',
            'date'  => now(),
        ]);

        DB::table('orders')->insert([
            'id' => 2,
            'client_id' => 1,
            'total'  => '1000',
             'date'  => now(),
        ]);

        DB::table('orders')->insert([
            'id' => 3,
            'client_id' => 2,
            'total'  => '1000',
            'date'  => now(),
        ]);
    }
}
