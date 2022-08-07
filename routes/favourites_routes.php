<?php

Route::post('/i/{item}', 'FavouriteItemController@addItem')->name('add');
Route::delete('/i/{item}', 'FavouriteItemController@removeItem')->name('remove');
Route::post('/clear', 'FavouriteItemController@clearFavourites')->name('clear');
