<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Artists;
use App\Repositories\Albums;
use App\Repositories\Genres;
use App\Repositories\Songs;
use App\Http\Requests\SongRequest;

class SongsController extends Controller
{
    //
    private $songs_repo ;
    private $artists_repo;
    private $albums_repo;
    private $genres_repo;

    public function __construct(Artists $artists,Albums $albums, Genres $genres, Songs $song){
        $this->songs_repo = $song;
        $this->artists_repo = $artists;
        $this->albums_repo = $albums;
        $this->genres_repo = $genres;
    }

    public function index(){
        $songs = $this->songs_repo->getAll();
        return view('admin.songs.index',compact('songs'));
    }
    public function showForm(){
        $albums = $this->albums_repo->getAll();
        $artists = $this->artists_repo->getAll();
        $genres = $this->genres_repo->getAll();
        return view('admin.songs.create', compact('albums','artists','genres'));
    }

    public function create(SongRequest $request)
    {
        if($this->songs_repo->create($request->except('_token'))){
            \Alert::success("Song added Succesfully","Success");
            return redirect()->route('admin_home');
        }else{
            \Alert::error("Fail adding song","Fail");
        }
    }
    public function edit($id){
        $song = $this->songs_repo->getSongById($id);
        
        $albums = $this->albums_repo->getAll();
        $artists = $this->artists_repo->getAll();
        $genres = $this->genres_repo->getAll();
        return view('admin.songs.edit', compact('albums','artists','genres','song'));

    }

    public function delete($id){

        if($this->songs_repo->delete($id)){
            \Alert::success("Delecting Song","Success");
            return redirect()->back();
        }else{
            \Alert::success("Success","Updated successful");
            return redirect()->back();
        }
    }

    public function update($id, SongRequest $request){
        if($this->songs_repo->update($id, $request->except('_token'))){
            \Alert::success("Success","Updated successful");
            return redirect()->back();
        }else{
            \Alert::error("Updating song","Failed");

        }


    }



}
