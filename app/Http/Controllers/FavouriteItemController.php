<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavouriteItemController extends Controller
{
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
}
