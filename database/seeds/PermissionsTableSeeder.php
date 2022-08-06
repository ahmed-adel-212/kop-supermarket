<?php

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            //
        	['name' => 'customer_index' , 'display_name' => 'Get All Customers'],
        	['name' => 'customer_create' , 'display_name' => 'Create New Customer'],
        	['name' => 'customer_edit' , 'display_name' => 'Edit Customer'],
            //
            ['name' => 'menu_index' , 'display_name' => 'Get All Menus'],
        	['name' => 'menu_create' , 'display_name' => 'Create New Menu'],
        	['name' => 'menu_edit' , 'display_name' => 'Edit Menu'],
            //
            ['name' => 'offer_index' , 'display_name' => 'Get All Offers'],
        	['name' => 'offer_create' , 'display_name' => 'Create New Offer'],
            ['name' => 'offer_edit' , 'display_name' => 'Edit Offer'],
            //
        	['name' => 'branch_index' , 'display_name' => 'Get All Branches'],
        	['name' => 'branch_create' , 'display_name' => 'Create New Branch'],
            ['name' => 'branch_edit' , 'display_name' => 'Edit Branch'],
            //
        	['name' => 'user_index' , 'display_name' => 'Get All Users'],
        	['name' => 'user_create' , 'display_name' => 'Create New User'],
            ['name' => 'user_edit' , 'display_name' => 'Edit User'],
            //
        	['name' => 'role_index' , 'display_name' => 'Get All Roles'],
        	['name' => 'role_create' , 'display_name' => 'Create New Role'],
            ['name' => 'role_edit' , 'display_name' => 'Edit Role'],
            //
        	['name' => 'order_index' , 'display_name' => 'Get All Orders'],
        ];

        $createdPermissions = array();

        foreach ($permissions as $permission) {
            $createdPermissions[] = Permission::create($permission);
        }

        $createdPermissions = collect($createdPermissions);


        $cashierPermission = $createdPermissions->filter(function($value, $key) {
            return strstr($value, 'customer') or strstr($value, 'menu') or strstr($value, 'offer') or strstr($value, 'branch');
        });

        // dd($cashierPermission->pluck('id'));

        $adminRole = Role::where('name', 'admin')->first()->permissions()->sync($createdPermissions->pluck('id'));
        $cashierRole = Role::where('name', 'cashier')->first()->permissions()->sync($cashierPermission->pluck('id'));

    }
}
