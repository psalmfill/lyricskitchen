<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Genres;
use App\Http\Requests\GenreRequest;

class GenresController extends Controller
{
    //
    private $genre_repo ;

    public function __construct(Genres $genre)
    {
        $this->genre_repo = $genre;
    }

    public function index(){
        $genres = $this->genre_repo->getAll();
        return \View::make('admin.genres.index',compact('genres'));
    }

    public function showForm(){
        
        return view('admin.genres.create');
    }

    public function create(GenreRequest $request)
    {   
        
        
        if($this->genre_repo->create($request->except('_token'))){
            \Alert::success("Success creating genre","Success");

            return redirect()->route('genre_home');
        }else{
            \Alert::error("Fail creating genre","Fail");

            return redirect()->back();
        }
    }

    public function delete($id)
    {
        if($this->genre_repo->delete($id)){
            \Alert::success("Success deleting genre","Success");
            return redirect()->route('admin.genre.home');
        }else{
            \Alert::error("Fail deleting genre","Fail");
            return redirect()->route('genre_home');
        }
    }

    public function edit($id){
        $genre = $this->genre_repo->getGenreById($id);

        return view('admin.genres.edit',compact('genre'));


    }

    public function update(GenreRequest $request, $id)
    {   
        
        if($this->genre_repo->update($id,$request->except('_token'))){
            \Alert::success("Success","Updated successful");

            return redirect()->route('admin.genre.home');
        }else{
            \Alert::error("Fail updating genre","Error");
            
            return redirect()->back();
        }
    }

}
