<?php
namespace App\Repositories;

use App\Genre;

class Genres {

    private $genre;

    public function __construct(Genre $genre)
    {
        $this->genre = $genre;
    }

    public function get(){
        return $this->genre;
    }

    public function getAll(){
        return $this->genre->all();
    }

    public function getGenreById($id){
        return $this->genre->findorfail($id);
    }

    public function create($data){

        if($this->genre->create($data)){
            return true;
        }
        else {
            return false;
        }
    }
    public function delete($id){
        $genre = $this->genre->find($id);
        if($genre !=null ){
            $genre->delete();
            return true;
        }else{
            return false;
        }

    }

    public function update($id, $data){

        $genre = $this->getGenreById($id);
        if($genre->update($data)){
            return true;
        }else{
            return false;
        }

    }
}