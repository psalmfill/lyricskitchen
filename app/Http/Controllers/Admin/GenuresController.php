<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Genures;
use App\Http\Requests\AlbumRequest;

class GenuresController extends Controller
{
    //
    private $genure_repo ;

    public function __construct(Genures $genure)
    {
        $this->genure_repo = $genure;
    }

    public function index(){
        $genures = $this->album_repo->getAll();
        return \View::make('admin.genure.index',compact('genures'));
    }

    public function create(AlbumRequest $request)
    {
        if($this->genure_repo->create($request)){

        }else{

        }
    }

    public function delete($id)
    {
        if($this->genure_repo->delete($id)){

        }else{

        }
    }

    public function update(GenureRequest $request, $id)
    {
        if($this->genure_repo->update($id,$request)){

        }else{
            
        }
    }

}
