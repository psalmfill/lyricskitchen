<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Albums;

class AlbumsController extends Controller
{
    //
    private $album_repo;
    public function __construct(Album $album )
    {
        $this->album_repo = $album;
    }

    public function index(){
        $albums = $this->album_repo->getAll();

        return \View::make('admin.album.index',compact('albums'));
        
    }
    public function create(AlbumRequest $request)
    {
        if($his->album_repo->create($request)){

        }
        else{

        }
    }
    public function delete($id){

        if($this->album_repo->delete($id)){
            
        }else{

        }
    }
    public function update(AlbumRequest $request){

    }
}
