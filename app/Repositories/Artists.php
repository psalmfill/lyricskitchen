<?php

namespace App\Repositories;
use App\Artist;
use App\Songs;

class Artists {

    private $artist;

    public function __construct(Artist $artist )
    {
        $this->artist = $artist;
    }

    public function getAll(){
        return $this->artist->all();
    }

    public function getArtistById($id)
    {
        return $this->artist->findorfail($id);
    }
    
    public function getArtistBySlug($slug)
    {
        return $this->artist->where('slug','=',$slug)->first();
    }

    public function getSongsByArtist($id){
        $artist = $this->getArtistById($id);
        return $artist->songs();
    }

    public function getAlbumsByArtist($id){
        $artist = $this->getArtistById($id);
        return $artist->albums();
    }

    public function create($data)
    {   $data['slug'] = get_slug($data['name'],"Artist");
        if($this->artist->create($data)){
            return true;
        }
        else{
            return false;
        }
        
    }
    public function delete($id)
    {   $artist = $this->artist->find($id);
        if($artist !=null){
             $artist->delete();
            return true;
        }else{
                return false;
            }
    }
}