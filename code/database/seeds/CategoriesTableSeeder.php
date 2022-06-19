<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {

        DB::table('categories')->insert(['id' => 1,'name' => 'Aperitivos', 'image'=>'aperitivos.png']);
        DB::table('categories')->insert(['id' => 2,'name' => 'Doces', 'image'=>'doces.png']);
        DB::table('categories')->insert(['id' => 3,'name' => 'Frutas Cristalizadas', 'image'=>'desidratadas.png']);
        DB::table('categories')->insert(['id' => 4,'name' => 'Frutos Secos', 'image'=>'secos.png']);
        DB::table('categories')->insert(['id' => 5,'name' => 'Sementes Naturais', 'image'=>'naturais.png']);
        DB::table('categories')->insert(['id' => 6,'name' => 'Farinhas', 'image'=>'farinhas.png']);


    }
}