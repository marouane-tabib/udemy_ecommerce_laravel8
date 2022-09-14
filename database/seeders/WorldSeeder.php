<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WorldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   
        // Set the path of your .sql file
        $world = public_path('udemy_ecommerce_world.sql');

        $db = [
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'host' => env('DB_HOST'),
            'database' => env('DB_DATABASE'),
        ];

        // You must change this one, its depend on your mysql bin.
        $db_bin = 'C:\xampp\mysql\bin';
        
       //$sql = storage_path('a_id_territory.sql');

       exec("{$db_bin}\mysql --user={$db['username']} --password={$db['password']} --host={$db['host']} --database={$db['database']} < $world");
    }
}
