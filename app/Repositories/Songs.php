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

    public function getSongbySlug($slug)
    {
        return $this->song->where('slug','=',$slug)->first();
    }

    public function getSongsByArtist($id){
        return $this->song->where('artist_id','=', $id)->get();
    }

    public function getArtist($id){

        return $this->getSongbyId($id)->artist();
    }

    public function getSongsByGenre($id){
        return $this->song->where('genre_id','=',$id)->paginate(20);
    }
    public function create($data){
        $data['slug'] = get_slug($data['title'],"Song");
        $data['tags'] = !empty($data['tags']) ? $data['tags']:"";
        $data['release_date'] = !empty($data['release_date']) ? $data['release_date']:"";
        $data['video_url'] = !empty($data['video_url']) ? $data['tags']:"";
        $song = new Song();
        $song->title =   $data['title'];
        $song->slug =   $data['slug'];
        $song->artist_id =   $data['artist_id'];
        $song->album_id =   $data['album_id'];
        $song->genre_id =   $data['genre_id'];
        $song->release_date =   $data['release_date'];
        $song->video_url =   $data['video_url'];
        $song->tags =   $data['tags'];
        $song->lyrics =   $data['lyrics'];
        if($song->save()){
            return true;
        }
        else{
            return false;
        }

    }
    public function delete($id){
        if($this->getSongbyId($id)->delete()){
        return true;
        }else{
            return false;
        }
    }

    public function update($id, $data){
        $song = $this->getSongbyId($id);
        if($song->update($data)){
            return true;
        }else{
            return false;
        }
        
    }
    

}
