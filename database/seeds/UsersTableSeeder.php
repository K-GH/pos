<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=\App\User::create([
            "fisrt_name"=>"super",
            "last_name"=>"admin",
            "email"=>"super_admin@app.con",
            "password"=> bcrypt("123456"),
        ]);

        $user->attachRole('super_admin');
    }
}
