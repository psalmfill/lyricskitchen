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

Route::get('/', 'PagesController@index')->name('homepage');
Route::get('/albums', 'AlbumsController@index')->name('albums.home');
Route::get('/album/{artist_slug}/{album_slug}','AlbumsController@album')->name('album.page');

Route::get('/artists/{index?}', 'ArtistsController@index')->name('artists.home');
Route::get('/artist/{slug}', 'ArtistsController@artist')->name('artist.page');

Route::get('/song/{artist_slug}/{song_slug}','SongsController@song')->name('song.single');

Route::get('/genres','GenresController@index')->name('genre.home');
Route::get('/genre/{genre_id}','SongsController@songs');
Route::get('/search','SearchController@search')->name('search');
Route::get('/songs', function () {
    return view('songs');
});
Route::get('/songsingle', function () {
    return view('song_single');
});
 
Route::group(['middleware'=>'web'], function(){
   Route::group(['middleware'=>'web'],function(){
            
        Route::prefix('admin')->group(function(){
            Route::namespace('Admin')->group(function(){
                Route::get('/','AdminController@index')->name('admin.home');

                Route::get('artists','ArtistsController@index')->name('admin.artist.home');
                Route::get('artists/create',function(){
                    return View::make('admin.artists.create');
                })->name('admin.artist.form');
                
                Route::post('artists/create','ArtistsController@create')->name('admin.artist.docreate');
                Route::get('datatables/artists','ArtistsController@getdata')->name('datatables.artists');
                Route::get('artist/{id}/edit', 'ArtistsController@edit')->name('admin.artist.edit');
                Route::post('artist/{id}/update', 'ArtistsController@update')->name('admin.artist.update');
                Route::get('artist/{id}/delete', 'ArtistsController@delete')->name('admin.artist.delete');
                Route::get('ajax/artists/get','ArtistsController@getartist')->name('admin.artists.get');

                Route::get('albums','AlbumsController@index')->name('admin.album.home');
                Route::get('album/create','AlbumsController@showForm')->name('admin.album.form');
                Route::post('album/create','AlbumsController@create')->name('admin.album.create');
                Route::get('album/{id}/delete','AlbumsController@delete')->name('admin.album.delete');
                Route::get('album/{id}/edit','AlbumsController@edit')->name('admin.album.edit');
                Route::post('album/{id}/update','AlbumsController@update')->name('admin.album.update');
                Route::get('ajax/albums/get','AlbumsController@getalbums')->name('admin.albums.get');
            

                Route::get('genres','GenresController@index')->name('admin.genre.home');
                Route::get('genre/create','GenresController@showForm')->name('admin.genre.form');
                Route::post('genre/create','GenresController@create')->name('admin.genre.create');
                Route::get('genre/{id}/delete','GenresController@delete')->name('admin.genre.delete');
                Route::get('genre/{id}/edit','GenresController@edit')->name('admin.genre.edit');
                Route::post('genre/{id}/update','GenresController@update')->name('admin.genre.update');

                Route::get('songs','SongsController@index')->name('admin.songs.home');
                Route::get('song/create','SongsController@showForm')->name('admin.song.form');
                Route::post('song/create','SongsController@create')->name('admin.song.create');
                Route::get('song/{id}/delete','SongsController@delete')->name('admin.song.delete');
                Route::get('song/{id}/edit','SongsController@edit')->name('admin.song.edit');
                Route::post('song/{id}/update','SongsController@update')->name('admin.song.update');

                Route::get('genius','GeniusController@index')->name('admin.genius.index');
                Route::get('genuis/song/add/{id}','GeniusController@song')->name('admin.genius.add');
            });

        });
    });


Route::get('/home', 'HomeController@index')->name('home');

});
Auth::routes();
Imgfly::routes();
Route::get('datatables', 'DatatablesController@getdata')->name('datatables.data');
