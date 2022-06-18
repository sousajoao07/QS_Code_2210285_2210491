<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {

        DB::table('users')->insert(['id' => 1,'email' => 'admin', 'password'=>'admin']);
    }
}