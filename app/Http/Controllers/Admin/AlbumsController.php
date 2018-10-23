<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Albums;
use App\Repositories\Artists;
use App\Http\Requests\AlbumRequest;

class AlbumsController extends Controller
{
    //
    private $album_repo;
    private $artist_repo;
    public function __construct(Albums $album,Artists $artist  )
    {
        $this->album_repo = $album;
        $this->artist_repo = $artist;
    }

    public function index(){
        $albums = $this->album_repo->getAll();

        return \View::make('admin.albums.index',compact('albums'));
        
    }


    public function showForm(){
        $artists = $this->artist_repo->getAll();
        return  \View::make('admin.albums.create',compact('artists'));
    }


    public function create(AlbumRequest $request)
    {
        if($this->album_repo->create($request)){
            \Alert::success("Success creating album","Success");

            return redirect()->route('album_home');
        }
        else{
            \Alert::error("Fail creating album","Fail");
            return redirect()->back();
        }
    }

    public function edit($id){
        $album = $this->album_repo->getAlbumById($id);
        $artists = $this->artist_repo->getAll();
        return view('admin.albums.edit', compact('artists','album'));
    }

    public function delete($id){

        if($this->album_repo->delete($id)){
            \Alert::success("Success deleting genre","Success");

            return redirect()->route('album_home');
        }else{
            \Alert::error("Fail creating genre","Fail");

            return redirect()->back();
        }
    }
    public function update($id,AlbumRequest $request){

        if($this->album_repo->update($id,$request->except('_token'))){
            \Alert::success("Success updating album","Success");
            return redirect()->back();
        }else{
            \Alert::error("Fail updating genre","Success");

            return redirect()->back();
        }
    }
    public function getalbums(Request $request){
        $data = [];

        if($request->has('id')){
            $data = $this->album_repo->pluck($request->get('id'));
        }
        return response()->json($data);
    }
}
