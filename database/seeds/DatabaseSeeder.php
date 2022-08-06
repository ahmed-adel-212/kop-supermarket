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
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(CitiesAndAreasTableSeeder::class);
        $this->call(DoughTypesSeeder::class);
        
        // $this->call(PyKhaledDummyDataSeeder::class);
    }
}
