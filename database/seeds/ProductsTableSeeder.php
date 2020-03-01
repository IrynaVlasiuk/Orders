<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
                'id' => 1,
                'name' => 'Macbook Air',
                 'total' => '1000'
            ]);
        DB::table('products')->insert([
            'id' => 2,
            'name' => 'The Matrix Trilogy',
            'total' => '1000'
        ]);
        DB::table('products')->insert([
            'id' => 3,
            'name' => 'Server Rack',
            'total' => '1000'
        ]);
    }
}
