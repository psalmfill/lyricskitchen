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
Route::group(['middleware'=>'admin'],function(){
    
Route::prefix('admin')->group(function(){
    Route::namespace('Admin')->group(function(){
        Route::get('/','AdminController@index')->name('admin_home');

        Route::get('artists','ArtistsController@index')->name('artist_home');
        Route::get('artists/create',function(){
            return View::make('admin.artists.create');
        })->name('artist_form');
        Route::post('artists/create','ArtistsController@create')->name('create_artist');
        Route::get('datatables/artists','ArtistsController@getdata')->name('datatables.artists');
        Route::get('artist/{id}/delete', 'ArtistsController@delete')->name('artist.delete');
        Route::get('ajax/artists/get','ArtistsController@getartist')->name('artists.get');

        Route::get('albums','AlbumsController@index')->name('album_home');
        Route::get('album/create','AlbumsController@showForm')->name('album_form');
        Route::post('album/create','AlbumsController@create')->name('create_album');
        Route::get('album/{id}/delete','AlbumsController@delete')->name('album.delete');
        Route::get('album/{id}/edit','AlbumsController@edit')->name('album.edit');
        Route::post('album/{id}/update','AlbumsController@update')->name('album.update');
        Route::get('ajax/albums/get','AlbumsController@getalbums')->name('albums.get');
    

        Route::get('genures','GenuresController@index')->name('genure_home');
        Route::get('genure/create','GenuresController@showForm')->name('genure_form');
        Route::post('genure/create','GenuresController@create')->name('create_genure');
        Route::get('genure/{id}/delete','GenuresController@delete')->name('genure.delete');
        Route::get('genure/{id}/edit','GenuresController@edit')->name('genure.edit');
        Route::post('genure/{id}/update','GenuresController@update')->name('genure.update');

        Route::get('songs','SongsController@index')->name('song_home');
        Route::get('song/create','SongsController@showForm')->name('song_form');
        Route::post('song/create','SongsController@create')->name('create_song');
        Route::get('song/{id}/delete','SongsController@delete')->name('song.delete');
        Route::get('song/{id}/edit','SongsController@edit')->name('song.edit');
        Route::post('song/{id}/update','SongsController@update')->name('song.update');


    });

});
});
Route::get('datatables', 'DatatablesController@getdata')->name('datatables.data');//, [
//     'anyData'  => 'datatables.data',
//     'getIndex' => 'datatables',
// ]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
