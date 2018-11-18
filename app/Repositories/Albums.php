<?php
namespace App\Repositories;

use App\Album;
use Illuminate\Support\Facades\Storage;
class Albums{

    private $album;

    public function __construct(Album $album)
    {   
        $this->album = $album;
    }

    public function get(){
        return $this->album;
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
        return $this->album->where('slug','=',$slug)->first();
    }
    public function create($request){
        $data = $request->except('_token');
        $data['slug'] = get_slug($data['title'],"Album");

        if ($request->hasFile('image')) {            
            $file = $request->file('image');
            $extension = $file->extension()?: 'png';
            $picture = str_random(10) . '.' . $extension;
            $destinationPath = public_path() . '/uploads/albums/';
            $file->move($destinationPath, $picture);
            $data['image'] = $picture;
        }
        if($this->album->create($data)){
            return true;
        }else{
            return false;
        }
    }
    public function update($id, $data){

        $album = $this->getAlbumById($id);
        $album_art = $album->image;
        $alup = [];
        $alup['title']=$data->get('title');
        $alup['slug']= get_slug($data->get('title'),"Album",$id);
        $alup['year']=$data->get('year');
        $alup['artist_id']=$data->get('artist_id');
        
        if ($data->hasFile('image')) {            
            $file = $data->file('image');
            $extension = $file->extension()?: 'png';
            $picture = str_random(10). '.' . $extension;
            $destinationPath = public_path() . '/uploads/albums/';
            $file->move($destinationPath, $picture);
            $alup['image'] = $picture;
        }
        if($album->update($alup)){

            if(file_exists(public_path() . '/uploads/albums/'.$album_art)){
                unlink(public_path() . '/uploads/albums/'.$album_art);
            }
            return true;
        }else{
            return false;
        }
    }
    public function delete($id){
        $album = $this->album->find($id);
        if($album !=null ){
            $album->delete();
            return true;
        }else{
            return false;
        }

    }
    public function pluck($id){
        return $this->album->where('artist_id','=',$id)->pluck('title','id');
    }
}