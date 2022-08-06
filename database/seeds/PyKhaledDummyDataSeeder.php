<?php

use Illuminate\Database\Seeder;

class PyKhaledDummyDataSeeder extends Seeder
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
            $order->items()->attach($items, [
                'price' => rand(1, 99.00),
                'offer_price' => rand(32,999.3)
            ]);
        });
    }
}
