<?php

use Illuminate\Database\Seeder;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
                'id' => 1,
                'name' => 'Acme',
            ]);
        DB::table('clients')->insert([
            'id' => 2,
            'name' => 'Apple',
        ]);
        DB::table('clients')->insert([
            'id' => 3,
            'name' => 'Microsoft',
        ]);
    }
}
