<?php

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
        	['name' => 'admin' , 'display_name' => 'Admin'],
        	['name' => 'cashier' , 'display_name' => 'Cashier'],
        	['name' => 'branch_admin' , 'display_name' => 'Branch Admin'],
        	['name' => 'customer' , 'display_name' => 'Customer'],
        ];

        foreach ($roles as $role) {
        	Role::create($role);
        }
    }
}
