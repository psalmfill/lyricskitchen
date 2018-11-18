<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Songs;
use App\Genre;

class SongsController extends Controller
{
    //
    private $songs_repo;
    public function __construct(Songs $repo){
        $this->songs_repo = $repo;
    }

    public function song($artist_slug, $song_slug){
        $song = $this->songs_repo->getSongBySlug($song_slug);
        $songs = $this->songs_repo->getSongsByArtist($song->artist->id);
        return view('song_single', compact('song','songs'));
    }
    public function songs($genre_slug){
        $genre = Genre::where('slug','=',$genre_slug)->first();
       $songs = $this->songs_repo->getSongsByGenre($genre->id);
       return  view('genre',compact('songs','genre'));
        
    }
}
