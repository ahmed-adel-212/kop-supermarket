<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteItemController extends Controller
{
    public function checkItem(Item $item)
    {
        $result = $item->isFavouredBy(Auth::user());

        return response()->json([
            'message' => $result,
        ]);
    }

    public function addItem(Item $item)
    {
        Auth::user()->addToFavourites($item);

        return response()->json([
            'message' => __('general.favourite.added'),
        ]);
    }

    public function removeItem(Item $item)
    {
        Auth::user()->removeFromFavourites($item);

        return response()->json([
            'message' => __('general.favourite.removed'),
        ]);
    }

    public function clearFavourites()
    {
        Auth::user()->clearFavourites();

        return response()->json([
            'message' => __('general.favourite.cleared'),
        ]);
    }

    public function count(Item $item)
    {
        return response()->json([
            'message' => $item->favouritesCount(),
        ]);
    }

    public function getFavourites()
    {
        return response()->json([
            'items' => Auth::user()->favourites()->paginate(),
        ]);
    }
}
