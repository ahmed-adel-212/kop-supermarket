<?php

namespace Tests\Unit;

use App\Models\Item;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_item_has_user_favourites()
    {
        $user = factory(User::class)->create([
            'activation_token' => 254613
        ]);
        $item = factory(Item::class)->create();

        $this->assertNotNull($item->favourites);

        $user->addToFavourites($item);

        $item->refresh();
        $this->assertCount(1, $item->favourites);
    }

    public function test_item_has_favourite_count()
    {
        $item = factory(Item::class)->create();

        $item->favourites()->attach(factory(User::class)->create([
            'activation_token' => 254613
        ]));
        $item->favourites()->attach(factory(User::class)->create([
            'activation_token' => 254613
        ]));
        $item->favourites()->attach(factory(User::class)->create([
            'activation_token' => 254613
        ]));

       $this->assertEquals(3,  $item->favouritesCount());
    }

    public function test_item_can_be_favoured_by_user()
    {
        $item = factory(Item::class)->create();
        $user = factory(User::class)->create([
            'activation_token' => 254613
        ]);

        $this->assertEquals(0,  $item->favouritesCount());

        $item->favouredBy($user);

        $this->assertEquals(1,  $item->favouritesCount());
        $this->assertEquals($item->favourites()->first()->id, $user->id);
    }

    public function test_item_can_be_un_favoured_by_user()
    {
        $item = factory(Item::class)->create();
        $user = factory(User::class)->create([
            'activation_token' => 254613
        ]);

        $item->favouredBy($user);
        $this->assertEquals(1,  $item->favouritesCount());

        $item->unFavouredBy($user);
        $this->assertEquals(0,  $item->favouritesCount());
    }

    public function test_item_can_be_checked_if_favoured_by_user()
    {
        $item = factory(Item::class)->create();
        $user = factory(User::class)->create([
            'activation_token' => 254613
        ]);

        $this->assertFalse($item->isFavouredBy($user));

        $item->favouredBy($user);

        $this->assertTrue($item->isFavouredBy($user));
    }
}
