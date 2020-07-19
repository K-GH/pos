<?php

use Illuminate\Database\Seeder;
use App\Client;
class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients=['khaled','omar','ahmed','mona','bola'];
        

        foreach ($clients as $client) {
            
            Client::create([
               'name'=> $client,
               'address'=>'address',
               'phone'=>011362,

            ]);
        }
    }
}
