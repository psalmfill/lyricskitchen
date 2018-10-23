<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Genures;
use App\Http\Requests\GenureRequest;

class GenuresController extends Controller
{
    //
    private $genure_repo ;

    public function __construct(Genures $genure)
    {
        $this->genure_repo = $genure;
    }

    public function index(){
        $genures = $this->genure_repo->getAll();
        return \View::make('admin.genures.index',compact('genures'));
    }

    public function showForm(){
        
        return view('admin.genures.create');
    }

    public function create(GenureRequest $request)
    {   
        
        
        if($this->genure_repo->create($request->except('_token'))){
            \Alert::success("Success creating genre","Success");

            return redirect()->route('genure_home');
        }else{
            \Alert::error("Fail creating genre","Fail");

            return redirect()->back();
        }
    }

    public function delete($id)
    {
        if($this->genure_repo->delete($id)){
            \Alert::success("Success deleting genre","Success");
            return redirect()->route('genure_home');
        }else{
            \Alert::error("Fail deleting genure","Fail");
            return redirect()->route('genure_home');
        }
    }

    public function edit($id){
        $genure = $this->genure_repo->getGenureById($id);

        return view('admin.genures.edit',compact('genure'));


    }

    public function update(GenureRequest $request, $id)
    {   
        
        if($this->genure_repo->update($id,$request->except('_token'))){
            \Alert::success("Success","Updated successful");

            return redirect()->route('genure_home');
        }else{
            \Alert::error("Fail updating genre","Error");
            
            return redirect()->back();
        }
    }

}
