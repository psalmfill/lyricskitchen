<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Artists;
use App\Repositories\Albums;
use App\Repositories\Songs;
use App\Repositories\Genures;

class AdminController extends Controller
{
    //
    private $artists_repo;
    private $albums_repo;
    private $songs_repo;
    private $genures_repo;

    public function __construct(Artists $artist,Albums $album, Songs $songs, Genures $genures)
    {   
        $this->artists_repo = $artist;
        $this->albums_repo = $album;
        $this->songs_repo = $songs;
        $this->genures_repo = $genures;
    }

    public function index()
    {
        $data = [
            'artists_count' => $this->artists_repo->getAll()->count(),
            'albums_count' => $this->albums_repo->getAll()->count(),
            'songs_count' => $this->songs_repo->getAll()->count(),
            'genures_count' => $this->genures_repo->getAll()->count(),
        ];
        return \View::make('admin.index',compact('data'));

    }

}
