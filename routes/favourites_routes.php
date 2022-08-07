<?php

Route::get('/i/{item}', 'FavouriteItemController@checkItem')->name('check');
Route::post('/i/{item}', 'FavouriteItemController@addItem')->name('add');
Route::delete('/i/{item}', 'FavouriteItemController@removeItem')->name('remove');
Route::post('/clear', 'FavouriteItemController@clearFavourites')->name('clear');


Route::get('/count/{item}', 'FavouriteItemController@count')->name('count');