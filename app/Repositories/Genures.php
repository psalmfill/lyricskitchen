<?php
namespace App\Repositories;

use App\Genure;

class Genures {

    private $genure;

    public function __construct(Genure $genure)
    {
        $this->genure = $genure;
    }

    public function getAll(){
        return $this->genure->all();
    }

    public function getGenureById($id){
        return $this->genure->findorfail($id);
    }

    public function create($data){

        if($this->genure->create($data)){
            return true;
        }
        else {
            return false;
        }
    }
    public function delete($id){
        $genure = $this->genure->find($id);
        if($genure !=null ){
            $genure->delete();
            return true;
        }else{
            return false;
        }

    }

    public function update($id, $data){

        $genure = $this->getGenureById($id);
        if($genure->update($data)){
            return true;
        }else{
            return false;
        }

    }
}