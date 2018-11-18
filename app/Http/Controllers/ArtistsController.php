<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Artists;
use App\Repositories\Songs;
use App\Artist;
class ArtistsController extends Controller
{
    //
    private $artists_repo;
    private $songs_repo;
    public function __construct(Artists $repo, Songs $songs){
        $this->artists_repo = $repo;
        $this->songs_repo = $songs;
    }
    public function index($index=null){

        if($index !==null && !is_numeric( $index)) {
            $active_index = explode("/",url()->current())[count(explode("/",url()->current()))-1];
            $artists = $this->artists_repo->getArtistsByIndex($index)->paginate(20);
            return view('artists',compact('artists','active_index'));

        }
        $artists = $this->artists_repo->get()->orderBy('name','asc')->paginate(20);
        
        return view('artists',compact('artists'));

    }

    public function artist($slug){
        $artist = $this->artists_repo->getArtistBySlug($slug);
        $songs = $this->songs_repo->getSongsByArtist($artist->id);
    
        return view('songs',compact('songs'));
    }
}
