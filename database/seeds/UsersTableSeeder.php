<?php
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where(['name'=>'admin'])->first();
        $cashierRole = Role::where(['name'=>'cashier'])->first();
        $customerRole = Role::where(['name'=>'customer'])->first();

        $admin = User::create([
        	'first_name' => 'admin',
        	'last_name' => 'user',
        	'name' => 'admin',
            'email' => 'admin@212solutions.com',
            'password' => bcrypt('password'),
            'activation_token' => '',
            'active' => 1
        ])->attachRole($adminRole);

        $cashier = User::create([
        	'first_name' => 'cashier',
        	'last_name' => 'user',
        	'name' => 'cashier',
        	'email' => 'cashier@212solutions.com',
            'password' => bcrypt('password'),
            'activation_token' => '',
            'active' => 1
        ])->attachRole($cashierRole);

        $customer = User::firstOrCreate([
            'first_name' => 'customer',
        	'last_name' => 'user',
        	'name' => 'customer',
        	'email' => 'customer@212solutions.com',
            'password' => bcrypt('password'),
            'activation_token' => '',
            'active' => 1,
        ])->attachRole($customerRole);

    }
}
