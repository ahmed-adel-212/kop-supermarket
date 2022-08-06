<?php

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Order::class, 40)->create()->each(function ($order) {
            $items = factory(App\Models\Item::class, rand(3,19))->create();
            $order->items()->sync($items);
        });


    }
}
