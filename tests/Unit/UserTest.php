<?php

namespace Tests\Unit;

use App\Models\Item;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_user_has_favourite_items()
    {
        $user = factory(User::class)->create([
            'activation_token' => 254613
        ]);

        $this->assertNotNull($user->favourites);
        $this->assertEmpty($user->favourites);
        
        $user->favourites()->attach(factory(Item::class)->create());
        
        $user->refresh();
        $this->assertCount(1, $user->favourites);
    }

    public function test_user_can_favourite_item()
    {
        $user = factory(User::class)->create([
            'activation_token' => 254613
        ]);
        $item = factory(Item::class)->create();

        $this->assertNotNull($user->favourites);
        $this->assertEmpty($user->favourites);
        $user->addToFavourites($item);

        $user->refresh();
        $this->assertCount(1, $user->favourites);
        $this->assertEquals($user->favourites->first()->id, $item->id);
    }

    public function test_user_can_remove_item_from_favourites()
    {
        $user = factory(User::class)->create([
            'activation_token' => 254613
        ]);
        $item = factory(Item::class)->create();

        
        $user->addToFavourites($item);

        $user->refresh();
        $this->assertCount(1, $user->favourites);

        $user->removeFromFavourites($item);

        $user->refresh();
        $this->assertEmpty($user->favourites);
    }

    public function test_user_can_clear_all_favourites()
    {
        $user = factory(User::class)->create([
            'activation_token' => 254613
        ]);
        $user->addToFavourites(factory(Item::class)->create());
        $user->addToFavourites(factory(Item::class)->create());
        $user->addToFavourites(factory(Item::class)->create());
        $user->addToFavourites(factory(Item::class)->create());

        $user->refresh();
        $this->assertCount(4, $user->favourites);

        $this->assertEquals(4, $user->clearFavourites());

        $user->refresh();
        $this->assertEmpty($user->favourites);
    }
}
