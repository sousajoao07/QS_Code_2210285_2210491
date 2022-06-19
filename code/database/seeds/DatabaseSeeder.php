<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public static $seedType = "small";
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info("-----------------------------------------------");
        $this->command->info("START of database seeder");
        $this->command->info("-----------------------------------------------");

        DatabaseSeeder::$seedType = $this->command->choice('What is the size of seed data (choose "full" for publishing)?', ['small', 'full'], 0);

        $this->call(CategoriesTableSeeder::class);


        $this->command->info("-----------------------------------------------");
        $this->command->info("END of database seeder");
        $this->command->info("-----------------------------------------------");
    }
}