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
    public function get(){
        return $this->artist;
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

    public function getArtistsByIndex($index){
        return $this->artist->where('name','like',$index .'%');
    }
    public function getArtistByName($name){
        return $this->artist->where('name','=',$name)->first();
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
                $picture = str_random(10). '.' . $extension;
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

    public function update($request, $id) {
        $artist = $this->artist->find($id);
        $artist_image = $artist->avatar;
        $updata = [
            'name' => $request->get('name'),
            'slug' => check_slug($request->get('name'),'Artist',$id),
            'biography' => $request->get('bio'),
            'year' => $request->get('year'),
        ];
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->extension()?: 'png';
            $picture = str_random(10) . '.' . $extension;
            $destinationPath = public_path() . '/uploads/artists/';
            $file->move($destinationPath, $picture);
            $updata['avatar'] = $picture;
        }else{
            $updata['avatar'] = "artist.jpg";
        }
        if($artist->update($updata)){
            
            if(file_exists(public_path().'uploads/artists/'.$artist_image)){
                uplink(public_path().'uploads/artists/'.$artist_image);
            }
            return true;
        }else{
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