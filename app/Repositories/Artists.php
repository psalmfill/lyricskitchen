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

    public function create($request)
    {  $data = $request->all();
        $artist = new Artist();
        $artist->name = $data['name'];
        $artist->slug = get_slug($data['name'],'Artist');
        $artist->year = $data['year'];
        $artist->biography = $data['bio'];
         if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->extension()?: 'png';
                $picture = $artist->slug . '.' . $extension;
                $destinationPath = public_path() . '/uploads/artists/';
                $file->move($destinationPath, $picture);
                $artist->avatar = $picture;
            }else{
                $artist->avatar = "artist.jpg";
            }
       
        if($artist->save()){
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