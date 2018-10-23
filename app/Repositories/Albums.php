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
    public function create($request){
        $data = $request->except('_token');
        $data['slug'] = get_slug($data['title'],"Album");
        
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->extension()?: 'png';
            $picture = $data['slug'] . '.' . $extension;
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

        if($album->update($data)){
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