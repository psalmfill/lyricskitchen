<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Artists;
use App\Repositories\Albums;
use App\Repositories\Songs;
use App\Repositories\Genres;

class AdminController extends Controller
{
    //
    private $artists_repo;
    private $albums_repo;
    private $songs_repo;
    private $genres_repo;

    public function __construct(Artists $artist,Albums $album, Songs $songs, Genres $genres)
    {   
        $this->artists_repo = $artist;
        $this->albums_repo = $album;
        $this->songs_repo = $songs;
        $this->genres_repo = $genres;
        $this->middleware('admin');
    }

    public function index()
    {
        $data = [
            'artists_count' => $this->artists_repo->getAll()->count(),
            'albums_count' => $this->albums_repo->getAll()->count(),
            'songs_count' => $this->songs_repo->getAll()->count(),
            'genres_count' => $this->genres_repo->getAll()->count(),
        ];
        $users = \App\User::all();
        return \View::make('admin.index',compact('users'));

    }

}
