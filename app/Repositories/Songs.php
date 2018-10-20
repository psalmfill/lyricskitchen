<?php
namespace App\Repositories;

use App\Song;
class Songs {

    private $song ;

    public function __construct(Song $song){

        $this->song = $song;
    }

    public function getAll(){

        return $this->song->all();
    }

    public function getSongbyId($id){

        return $this->song->findorfail($id);
    }

    public function getSongsbySlug($slug)
    {
        return $this->song->where('slug','=',$slug)->first();
    }

    public function getArtist($id){

        return $this->getSongbyId($id)->artist();
    }

    public function create($data){
        $data['slug'] = get_slug($data['name'],"Song");
        if($this->song->create($data)){
            return true;
        }
        else{
            return false;
        }

    }
    public function delete($id){
        if($this.getSongbyId($id)->delete()){
        return true;
        }else{
            return false;
        }
    }

    

}
