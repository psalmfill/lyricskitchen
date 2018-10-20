<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function(){
    Route::namespace('Admin')->group(function(){
        Route::get('/','AdminController@index');
        Route::get('artists','ArtistsController@index');
        Route::get('artists/create',function(){
            return View::make('admin.artists.create');
        });
        Route::post('artists/create','ArtistsController@create')->name('create_artist');

    });

});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
