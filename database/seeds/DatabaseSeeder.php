<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        // for LaratrustSeeder package
        $this->call(LaratrustSeeder::class);
        //for UsersTableSeeder
        $this->call(UsersTableSeeder::class);
      
    }
}
