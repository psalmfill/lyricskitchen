<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Albums;

class AlbumsController extends Controller
{
    //
    private $albums_repo;

    public function __construct(Albums $albums){
        $this->albums_repo = $albums;
    }

    public function index(){
        $albums = $this->albums_repo->get()->paginate(20);
        
        return view('albums', compact('albums'));
    }
    public function album($artist_slug, $album_slug){
        $album = $this->albums_repo->getAlbumBySlug($album_slug);
    return view('album_single',compact('album'));
   
    }
}
