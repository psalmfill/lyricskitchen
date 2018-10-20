<?php
namespace App\Repositories;

use App\Album;

class Albums{

    private $album;

    public function __construct(Album $album)
    {   
        $this->album = $album;
    }

    public function getAll()
    {
        return $this->album->all();
    }

    public function getAlbumById($id)
    {
        return $this->album->findorfail($id);
    }

    public function getAlbumBySlug($slug){
        return $this->artist->where('slug','=',$slug)->first();
    }
    public function create($data){
        $data['slug'] = get_slug($data['name'],"Albums");
        if($this->album->create($data)){
            return true;
        }else{
            return false;
        }
    }
}