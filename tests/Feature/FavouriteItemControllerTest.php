<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class FavouriteItemControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_un_authorized_user_can_not_add_item_to_favourites()
    {
        $this->postJson(route('favoutites.add', [factory(Item::class)->create()]))->assertUnauthorized();
    }

    public function test_user_can_add_item_to_favourites()
    {
        $user = factory(User::class)->create([
            'activation_token' => 254613
        ]);

        $item = factory(Item::class)->create();

        $res = $this->actingAs($user)->postJson(route('favourites.add', [$item->id]))->assertOk();

        $this->assertEquals(__('general.favourite.added'), $res->decodeResponseJson()['message']);
        $this->assertEquals(1, $item->favouritesCount());
    }

    public function test_user_can_remove_item_from_favourietes()
    {
        $user = factory(User::class)->create([
            'activation_token' => 254613
        ]);

        $item = factory(Item::class)->create();

        $res = $this->actingAs($user)->delete(route('favourites.remove', [$item->id]))->assertOk();

        $this->assertEquals(__('general.favourite.removed'), $res->decodeResponseJson()['message']);
        $this->assertEquals(0, $item->favouritesCount());
    }

    public function test_user_can_clear_favourites()
    {
        $user = factory(User::class)->create([
            'activation_token' => 254613
        ]);

        $res = $this->actingAs($user)->postJson(route('favourites.add', [factory(Item::class)->create()]))->assertOk();
        $res = $this->actingAs($user)->postJson(route('favourites.add', [factory(Item::class)->create()]))->assertOk();
        $res = $this->actingAs($user)->postJson(route('favourites.add', [factory(Item::class)->create()]))->assertOk();
        $res = $this->actingAs($user)->postJson(route('favourites.add', [factory(Item::class)->create()]))->assertOk();

        $user->refresh();
        $this->assertCount(4, $user->favourites);

        $res = $this->actingAs($user)->postJson(route('favourites.clear'))->assertOk();

        $this->assertEquals(__('general.favourite.cleared'), $res->decodeResponseJson()['message']);
        $user->refresh();
        $this->assertCount(0, $user->favourites);
    }

    public function test_user_can_check_if_favoured_item_before()
    {
        $user = factory(User::class)->create([
            'activation_token' => 254613
        ]);
        $item = factory(Item::class)->create();
        $res = $this->actingAs($user)->postJson(route('favourites.add', [$item->id]))->assertOk();

        $res = $this->actingAs($user)->get(route('favourites.check', [$item->id]))->assertOk();

        $this->assertTrue($res->decodeResponseJson()['message']);
    }

    public function test_item_can_get_favourites_count()
    {
        $item = factory(Item::class)->create();

        $item->favouredBy(factory(User::class)->create([
            'activation_token' => 254613
        ]));
        $item->favouredBy(factory(User::class)->create([
            'activation_token' => 254613
        ]));
        $item->favouredBy(factory(User::class)->create([
            'activation_token' => 254613
        ]));

        $res = $this->actingAs(factory(User::class)->create([
            'activation_token' => 254613
        ]))->get(route('favourites.count', [$item->id]))->assertOk();

        $this->assertEquals($res->decodeResponseJson()['message'], 3);
    }

    public function test_user_can_get_paginated_favourtes()
    {
        $user = factory(User::class)->create([
            'activation_token' => 254613
        ]);

        $res = $this->actingAs($user)->postJson(route('favourites.add', [factory(Item::class)->create()]))->assertOk();
        $res = $this->actingAs($user)->postJson(route('favourites.add', [factory(Item::class)->create()]))->assertOk();
        $res = $this->actingAs($user)->postJson(route('favourites.add', [factory(Item::class)->create()]))->assertOk();
        $res = $this->actingAs($user)->postJson(route('favourites.add', [factory(Item::class)->create()]))->assertOk();

        $this->assertEquals(4, $user->favourites()->count());

        $res = $this->actingAs($user)->get(route('favourites.get'))->assertOk();

        $this->assertArrayHasKey('items', $res->decodeResponseJson());
    }
}
