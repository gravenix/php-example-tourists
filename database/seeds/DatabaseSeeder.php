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
        //my seeders
        $this->call(FlightSeeder::class);
        $this->call(UserAdminSeeder::class);
        $this->call(UserSeeder::class);
    }
}
